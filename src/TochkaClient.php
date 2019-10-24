<?php


namespace MrSayrax\Tochka;

use MrSayrax\Tochka\TochkaRequest;

class TochkaClient
{
    protected $url;
    protected $httpClient;
    protected $accessToken;
    private   $tokenService;

    /**
     * ClientHint constructor.
     */
    public function __construct()
    {
        $this->config = config('tochka');
        $this->tokenService = new TochkaTokenService();
    }


    /**
     * Create GET request to bank API
     *
     * @param string|null $uri
     * @return object|null
     */
    protected function getResponse(string $uri = null)
    {
        $full_path = $this->tokenService->url . $this->tokenService->apiMode . $uri;

        $request = TochkaRequest::makeRequest($full_path, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
            ]
        ], 'get');

        if ($request['response'] && $request['statuse'] === 200 ) {
            return (object) json_decode($request['response']);
        }

        return null;
    }

    /**
     * Create POST request to bank API
     *
     * @param string|null $uri
     * @param array $post_params
     * @return object|null
     */
    protected function postResponse(string $uri = null, array $post_params = [])
    {
        $full_path = $this->tokenService->url . $this->tokenService->apiMode . $uri;

        $request = TochkaRequest::makeRequest($full_path, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
            ],
            'json' => $post_params
        ], 'post');

        if ($request['response'] && $request['statuse'] === 200 ) {
            return (object) json_decode($request['response']);
        }

        return null;
    }

}
