<?php

use Benlipp\SparkPay\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{

    public function testSyntax()
    {
        $client = new Client('http://www.google.com/', '123apikey');
        $this->assertTrue(is_object($client));
    }

}