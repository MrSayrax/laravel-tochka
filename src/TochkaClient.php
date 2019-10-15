<?php


namespace MrSayrax\Tochka;


use GuzzleHttp\Client;

class TochkaClient
{
    protected $url;
    protected $httpClient;
    protected $accessToken;
  //  private $tokensService;

    /**
     * ClientHint constructor.
     */
    public function __construct()
    {
        $this->config = config('tochka');
        $this->accessToken = $this->config['token'];
    }


    /**
     * Create GET request to bank API
     *
     * @param string|null $uri
     * @return object|null
     */
    protected function getResponse(string $uri = null)
    {
        $full_path = $this->tokensService->url . $this->tokensService->apiMode . $uri;

        $request = $this->getHttpClient()->get($full_path, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
            ],
            'params' => ['access_token' => $this->getAccessToken()]
        ]);

        $response = $request ? $request->getBody()->getContents() : null;
        $status = $request ? $request->getStatusCode() : 500;

        if ($response && $status === 200 && $response !== 'null') {
            return (object) json_decode($response);
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
        $full_path = $this->tokensService->url . $this->tokensService->apiMode . $uri;

        $request = $this->getHttpClient()->post($full_path, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
            ],
            'json' => $post_params
        ]);

        $response = $request ? $request->getBody()->getContents() : null;
        $status = $request ? $request->getStatusCode() : 500;

        if ($response && $status === 200 && $response !== 'null') {
            return (object) json_decode($response);
        }

        return null;
    }

    private function getHttpClient(){

        if (is_null($this->httpClient)) {
            $this->httpClient = new Client();
        }
        return $this->httpClient;
    }


}
