<?php

namespace Benlipp\SparkPay;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\RequestInterface;

class Client
{

    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $apiKey;


    /**
     * Build the client.
     * @param string $url
     * @param string $apiKey
     */
    public function __construct($url, $apiKey)
    {
        $this->url = self::formatUrl($url);
        $this->apiKey = $apiKey;
        $stack = new HandlerStack();
        $stack->push($this->authHandler());
        $this->httpClient = new HttpClient([
            'handler'  => $stack,
            'base_uri' => $this->url,
            'timeout'  => 5,
        ]);
    }

    /**
     * Auth handler for Client
     * @return \Closure
     */
    private function authHandler()
    {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                $request = $request->withHeader('X-AC-Auth-Token', $this->apiKey);

                return $handler($request, $options);
            };
        };
    }

    /**
     * Format the provided store url into the API url.
     * @param $url
     * @return string
     */
    private static function formatUrl($url)
    {
        $url = rtrim($url, "/");

        return "$url/api/v1/";
    }

}