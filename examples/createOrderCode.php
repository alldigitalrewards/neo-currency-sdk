<?php

use AllDigitalRewards\NeoCurrency\Client;
use AllDigitalRewards\NeoCurrency\Order\OrderCodeRequest;
use AllDigitalRewards\NeoCurrency\Order\OrderCodeResponse;

require __DIR__ . '/../vendor/autoload.php';

$request = new OrderCodeRequest(
    'aclientid',
    'someaccesstoken',
    1, // use the USD campaign, whatever yours is note prod and sandbox will be different
    100, // this is the Product (Brand) id you want to purchase
    "1.00",
);

$client = new Client();
/** @var OrderCodeResponse $order */
$order = $client->request($request);
print_r($order->getOrder()->getOrderId());
print_r($order->getCodeUrls());
