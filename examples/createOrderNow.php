<?php

use AllDigitalRewards\NeoCurrency\Client;
use AllDigitalRewards\NeoCurrency\Order\OrderNowRequest;
use AllDigitalRewards\NeoCurrency\Order\OrderResponse;

require __DIR__ . '/../vendor/autoload.php';

$request = new OrderNowRequest(
    'client_id-here',
    'a-token-here',
    1344,
    "1.00",
    1,
    "123456",
    "test2@test.com"
);

$client = new Client();
/** @var OrderResponse $order */
$order = $client->request($request);
var_dump($order->getOrder());

