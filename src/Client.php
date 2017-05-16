<?php

namespace Benlipp\SparkPay;

class Client
{


    //protected $httpClient;

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
        $this->url = $url;
        $this->apiKey = $apiKey;
    }

}