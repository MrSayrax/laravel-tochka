<?php

namespace MrSayrax\Tochka\Facades;
/**
 * @method static object|null getOrganisationList()
 * @method static object|null getAccountList()
 * @method static object|null getBankStatement(array $params)
 **/


class Tochka extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tochka';
    }
}
