<?php


namespace MrSayrax\Tochka;

use Illuminate\Support\Facades\Cache;

class TochkaTokenService
{
    private $authorisation_code;
    private $refresh_token;

    public function __construct()
    {
        $this->refresh_token = Cache::get('tochka_refresh_token');
    }


    public function getData()
    {
        Cache::put('tochka_access_token', 'test');
    }
}
