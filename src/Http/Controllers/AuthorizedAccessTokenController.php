<?php


namespace MrSayrax\Tochka\Http\Controllers;


use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use MrSayrax\Tochka\TochkaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthorizedAccessTokenController
{

    protected $url = 'https://enter.tochka.com/';
    protected $data = null;

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
        $this->data = Cache::get('laravel-tochka-data', []);
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

        try {
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
        } catch (Exception $e) {
            dd($e);
        }

        $response = json_decode($response['response']);

        $this->data[Auth::user()->id] = $response;

        Cache::put('laravel-tochka-data', $this->data);



        dd($response);
    }
}
