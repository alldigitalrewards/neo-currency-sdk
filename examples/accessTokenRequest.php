<?php

use AllDigitalRewards\NeoCurrency\Auth\AccessTokenRequest;
use AllDigitalRewards\NeoCurrency\Auth\AccessTokenResponse;
use AllDigitalRewards\NeoCurrency\Client;

require __DIR__ . '/../vendor/autoload.php';

$request = new AccessTokenRequest(
    'W3K86VL0ZLSUJWJQQ7KWHFD9',
    'ZTWPH4SCZP6JXOA6OLM12W15BYG3UMBDOXBH8E2TL7037F9R',
    'jhoughtelin@alldigitalrewards.com',
    'TmGX*eV%iw2F',
);

$client = new Client();
/** @var AccessTokenResponse $accessTokenResponse */
$accessTokenResponse = $client->request($request);
var_dump($accessTokenResponse->getAccessToken());
