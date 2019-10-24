<?php

namespace MrSayrax\Tochka\Http\Controllers;


use Illuminate\Contracts\Routing\ResponseFactory;


class AuthorizationController
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
     */
    public function authorize()
    {
        $mode = strtolower(config('tochka.method'));

        if ($mode === 'api') {
            $client_id = config('tochka.client_id');

            if (!$client_id) {
                echo 'Unspecified client_id.';
                return false;
            }

            return $this->response->redirectTo( $this->url."api/v1/authorize/?response_type=code&client_id={$client_id}");
        }

        return $this->response->redirectTo( $this->url."sandbox/v1/login/");
    }


}
