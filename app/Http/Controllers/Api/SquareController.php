<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Square\Customer\AddCardService;
use App\Services\Square\Customer\CreateCustomerService;
use App\Services\Square\Customer\DisableCardService;
use App\Services\Square\Payment\CompletedPaymentService;
use App\Services\Square\Payment\CreatePaymentService;
use App\Services\Square\Payment\GetListPaymentsService;
use Illuminate\Http\Request;

class SquareController extends Controller
{
    /**
     * Create customer to Square
     * @param Request $request
     * @param CreateCustomerService $service
     * @return null
     */
    public function createCustomer(Request $request, CreateCustomerService $service)
    {
      return $service->handle($request);
    }

    /**
     * Add card to Customer
     *
     * @param Request $request
     * @param \App\Services\Square\Customer\AddCardService $service
     * @return \Square\Models\Error[]
     */
    public function addCard(Request $request, AddCardService $service)
    {
        return $service->handle($request);
    }

    /**
     * Disable card in square and remove in system
     *
     */
    public function disableCard(Request $request, DisableCardService $service)
    {
        return $service->handle($request);
    }

    /**
     * Create payment
     *
     * @param Request $request
     * @param CreatePaymentService $service
     * @return void
     */
    public function createPayment(Request $request, CreatePaymentService $service)
    {
        return $service->handle($request);
    }

    /**
     * Get list payments
     */
    public function listPayments(Request $request, GetListPaymentsService $service)
    {
        return $service->handle($request);
    }

    /**
     * Handle completed payment
     *
     * @param Request $request
     * @param CompletedPaymentService $service
     * @return void
     */
    public function completedPayment(Request $request, CompletedPaymentService $service)
    {
        return $service->handle($request);
    }
}
