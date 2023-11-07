<?php

namespace App\Services\Auth;

use App\Exceptions\CustomException;
use App\Mail\Auth\ResetPasswordMail;
use App\Models\PasswordReset;
use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ChangePasswordService
{
    private $repository;

    /**
     * Construction
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle create a password reset token
     *
     * @param $request
     * @return true
     * @throws CustomException
     * @throws ValidationException
     */
    public function handle($request)
    {
        $user = auth()->user();
        $email = $user->email;
        $attrs = $request->validated();

        Validator::make($attrs, [
            'old_password' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail(__('messages.request.fail.incorrect_password'));
                    }
                }
            ]
        ])->validateWithBag('updatePassword');

        $encode = Crypt::encrypt($attrs['new_password']);
        $attrs['url'] = Request::root() . '/auth/change-password/' . $encode;

        PasswordReset::updateOrCreate([
            'email' => $email
        ], [
            'token' => $encode
        ]);

        Mail::to($email)->send(new ResetPasswordMail($attrs));

        return true;
    }

    /**
     * Handle change password confirmation.
     *
     * @param $request
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function complete($request, $token)
    {
        $model = PasswordReset::where('token', $token)->first();
        $user = User::where('email', $model->email)->first();

        if ($user->role_id != $request->user()->role_id) {
            abort(403);
        }

        $pass = Crypt::decrypt($token);
        User::where('email', $model->email)->update(['password' => Hash::make($pass)]);
        PasswordReset::where('email', $model->email)->delete();

        return redirect()->route('dashboard');
    }
}
