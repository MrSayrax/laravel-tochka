<?php


namespace MrSayrax\Tochka;

use GuzzleHttp\Client;

class TochkaRequest
{
    /**
     * @var TochkaRequest
     */
    private static $instance;
    private $httpClient;

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    private static function getInstance(): TochkaRequest
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from TochkaRequest::getInstance() instead
     */
    private function __construct()
    {
    }

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone()
    {
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    private function __wakeup()
    {
    }


    public static function makeRequest(string $url,  array $options, string $method = 'get')
    {
        $request =  ($method === 'get') ? self::getInstance()->getHttpClient()->get($url, $options)
            : self::getInstance()->getHttpClient()->post($url, $options);

        if ($request === 'null') {
            $request = null;
        }

        return [
            'response' => $request ? $request->getBody()->getContents() : null,
            'status'   => $request ? $request->getStatusCode() : 500
        ];
    }


    private function getHttpClient(){

        if (is_null($this->httpClient)) {
            $this->httpClient = new Client();
        }
        return $this->httpClient;
    }
}
