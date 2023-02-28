<?php

namespace AllDigitalRewards\NeoCurrency;

use GuzzleHttp\ClientInterface;
use Psr\Http\Client\ClientExceptionInterface;

class Client
{
    private ClientInterface $httpClient;

    public function __construct(ClientInterface $httpClient = null)
    {
        if ($httpClient === null) {
            $httpClient = new \GuzzleHttp\Client();
        }

        $this->httpClient = $httpClient;
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function request(HasResponse $request)
    {
        $responseObjClass = $request->getResponseObject();

        return new $responseObjClass(
            $this->httpClient->sendRequest($request)
        );
    }
}
