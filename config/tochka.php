<?php
    return [
        //default value is TOCHKA_API_MODE=SANDBOX, set it TOCHKA_API_MODE=API, for use with real api
        "mode" => env('TOCHKA_API_MODE', 'SANDBOX'),
        "client_id" => env('TOCHKA_CLIENT_ID', 'sandbox'),
        "client_secret" => env('TOCHKA_CLIENT_SECRET', 'sandbox_secret'),
        "redirect_url " => env('TOCHKA_REDIRECT_URL', ''),
    ];
