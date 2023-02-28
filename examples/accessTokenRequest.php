<?php

use AllDigitalRewards\NeoCurrency\Auth\AccessTokenRequest;
use AllDigitalRewards\NeoCurrency\Auth\AccessTokenResponse;
use AllDigitalRewards\NeoCurrency\Client;

require __DIR__ . '/../vendor/autoload.php';

$request = new AccessTokenRequest(
    'client_id',
    'client_secret',
    'example@gmail.com',
    'password',
);

$client = new Client();
/** @var AccessTokenResponse $accessTokenResponse */
$accessTokenResponse = $client->request($request);
var_dump($accessTokenResponse->getAccessToken());