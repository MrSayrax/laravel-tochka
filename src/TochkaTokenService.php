<?php


namespace MrSayrax\Tochka;

use Illuminate\Support\Facades\Cache;

class TochkaTokenService
{
    public function getData()
    {
        Cache::put('tochka_access_token', 'test');
    }
}
