<?php

namespace AllDigitalRewards\Tests;

use AllDigitalRewards\NeoCurrency\Client;
use AllDigitalRewards\NeoCurrency\Exceptions\ConflictingOrderException;
use AllDigitalRewards\NeoCurrency\Orders\Order;
use AllDigitalRewards\NeoCurrency\Orders\OrderRequest;
use AllDigitalRewards\NeoCurrency\Orders\OrderRequestLineItem;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testClientTurnsNeoCurrencyErrorStatusIntoTypedException(): void
    {
        $client = new Client(new \GuzzleHttp\Client(['handler' => HandlerStack::create(new MockHandler([
            new Response(409, [], '{"poNumber":"guid-123","previousOrderIds":["EX-1"]}'),
        ]))]));

        $this->expectException(ConflictingOrderException::class);

        $client->request(new OrderRequest(
            'bearer-abc',
            Order::TYPE_LINKS,
            'guid-123',
            [new OrderRequestLineItem('PRODUCTA', 15, 1)]
        ));
    }
}
