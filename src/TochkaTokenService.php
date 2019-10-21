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

        if (!$this->refresh_token) {
            $client_id = config('tochka.client_id');
            $response = TochkaRequest::makeRequest("api/v1/authorize/?response_type=code&client_id={$client_id}");
        }
    }

    public function getData()
    {
        Cache::put('tochka_access_token', 'test');
    }
}
