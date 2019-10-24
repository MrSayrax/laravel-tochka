<?php


namespace MrSayrax\Tochka\Http\Controllers;


use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Request;
use MrSayrax\Tochka\TochkaRequest;

class AuthorizedAccessTokenController
{

    protected $url = 'https://enter.tochka.com/';
    /**
     * The response factory implementation.
     *
     * @var \Illuminate\Contracts\Routing\ResponseFactory
     */
    protected $response;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Routing\ResponseFactory  $response
     * @return void
     */
    public function __construct( ResponseFactory $response)
    {
        $this->response = $response;
    }


    /**
     * Authorize a client to access the user's account.
     *
     * @param \Illuminate\Support\Facades\Request $request
     * @return void
     */
    public function forUser(Request $request)
    {
        $mode = strtolower(config('tochka.mode'));
        $url = $this->url.'sandbox/v1/oauth2/token';

        if ($mode === 'api') {
            $client_id = config('tochka.client_id');

            if (!$client_id) {
                echo 'Unspecified client_id.';
                return false;
            }
            $url = $this->url.'api/v1/oauth2/token';
        }

        $response = TochkaRequest::makeRequest($url,[
            'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
            'json' => [
                'grant_type' => 'authorization_code',
                'code' => $request->code,
                'client_id' => config('tochka.client_id'),
                'client_secret' => config('tochka.client_secret'),
            ]
        ] , 'post');

        dd($response);
    }
}
