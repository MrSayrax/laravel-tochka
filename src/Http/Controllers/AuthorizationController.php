<?php

namespace MrSayrax\Tochka\Http\Controllers;


use Illuminate\Contracts\Routing\ResponseFactory;


class AuthorizationController
{


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
        return $this->response->view('tochka::authorize', [
            'client_id' => config('tochka.client_id')
        ]);
    }


}
