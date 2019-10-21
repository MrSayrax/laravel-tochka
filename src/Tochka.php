<?php


namespace MrSayrax\Tochka;


use Illuminate\Support\Facades\Route;
use MrSayrax\Tochka\RouteRegistrar;

class Tochka extends TochkaClient
{

    /** 
     * Get list of organizations and accounts
     *
     * @return object|null 
     */
    public function getOrganisationList()
    {
        return $this->getResponse('/v1/organizations/list');
    }

    /** 
     * Get account list
     *
     * @return object|null 
     */
    public function getAccountList()
    {
        return $this->getResponse('/v1/account/list');
    }

    /** 
     * Get bank statement 
     *
     * @param array $params
     *
     *   "account_code": "Account Number", 
     *   "bank_code": "Bank Identifier", 
     *   "date_end": "Statement last date , Y-m-d", 
     *   "date_start": "Statement first date, Y-m-d" 
     *
     * @return object|null
     */

    public function getBankStatement(array $params)
    {
        return $this->postResponse('/v1/statement', $params);
    }

    /**
     * Binds the Tochka routes into the controller.
     *
     * @param  callable|null  $callback
     * @param  array  $options
     * @return void
     */
    public static function routes($callback = null, array $options = [])
    {
        $callback = $callback ?: function ($router) {
            $router->all();
        };

        $defaultOptions = [
            'prefix' => 'tochka',
            'namespace' => '\MrSayrax\Tochka\Http\Controllers',
        ];

        $options = array_merge($defaultOptions, $options);

        Route::group($options, function ($router) use ($callback) {
            $callback(new RouteRegistrar($router));
        });
    }

}
