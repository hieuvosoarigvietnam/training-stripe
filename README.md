# README #
This is a repository for storage code of Training Stripe

## Note for GIT
* Please help apply GitFlow for this repository (https://danielkummer.github.io/git-flow-cheatsheet)
* Example:
    - Name for any features -> `feature/xxx-yyy` . Ex: `feature/implement-login-ui`
    - Name for any bugs -> `hotfix/xxx-yyy`. Ex: `hotfix/wrong-message-when-login`

* When you create a name for the Pull Request, please help set a meaningful name and set description if needed. Should capitalize the first letter and do not use special characters

## Required environment version
* `php >= 8.1.x`
* `node >= 14.21.x`
* `npm >= 6.14.x`

## Steps build
* Run `composer install` then run `npm install` for install app's dependencies
* Run `php artisan key:generate` for generate Laravel APP_KEY
* Run `php artisan migrate --seed` for create database and seed data
* Run `npm run build` for repeat generate mixing
* Start server `php artisan serve`
* If you want to watch your changes for development, run `npm run dev`

## Author
* Company: SoarigVN
