<?php

use AllDigitalRewards\NeoCurrency\Brands\BrandsRequest;
use AllDigitalRewards\NeoCurrency\Brands\BrandsResponse;
use AllDigitalRewards\NeoCurrency\Client;

require __DIR__ . '/../vendor/autoload.php';

$request = new BrandsRequest('a-fake-token');
$client = new Client();
/** @var BrandsResponse $response */
$response = $client->request($request);
var_dump($response->getBrands());
