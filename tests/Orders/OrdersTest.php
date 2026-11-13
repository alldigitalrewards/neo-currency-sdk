<?php

namespace AllDigitalRewards\Tests\Orders;

use AllDigitalRewards\NeoCurrency\Exceptions\ApiException;
use AllDigitalRewards\NeoCurrency\Exceptions\ConflictingOrderException;
use AllDigitalRewards\NeoCurrency\Exceptions\InsufficientFundsException;
use AllDigitalRewards\NeoCurrency\Exceptions\ValidationException;
use AllDigitalRewards\NeoCurrency\Orders\GetOrderRequest;
use AllDigitalRewards\NeoCurrency\Orders\Order;
use AllDigitalRewards\NeoCurrency\Orders\OrderRequest;
use AllDigitalRewards\NeoCurrency\Orders\OrderRequestLineItem;
use AllDigitalRewards\NeoCurrency\Orders\OrderResponse;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class OrdersTest extends TestCase
{
    public function testOrderRequestPostsLinksOrderKeyedOnPoNumber(): void
    {
        $request = new OrderRequest(
            'bearer-abc',
            Order::TYPE_LINKS,
            'guid-123',
            [new OrderRequestLineItem('PRODUCTA', 15.5, 2, 'guid-123')]
        );

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('https://stage.api.yourdigitalreward.com/v1/Orders', (string)$request->getUri());
        $this->assertSame('Bearer bearer-abc', $request->getHeaderLine('Authorization'));
        $this->assertSame('application/json', $request->getHeaderLine('Content-Type'));
        $this->assertSame(
            [
                'type' => 'Links',
                'poNumber' => 'guid-123',
                'lineItems' => [
                    ['productId' => 'PRODUCTA', 'value' => 15.5, 'quantity' => 2, 'externalId' => 'guid-123'],
                ],
            ],
            json_decode((string)$request->getBody(), true)
        );
        $this->assertSame(OrderResponse::class, $request->getResponseObject());
    }

    public function testOrderRequestSendsDepartmentOnlyWhenGiven(): void
    {
        $request = new OrderRequest(
            'bearer-abc',
            Order::TYPE_LINKS,
            'guid-123',
            [new OrderRequestLineItem('PRODUCTA', 15, 1)],
            'Dept123'
        );

        $body = json_decode((string)$request->getBody(), true);
        $this->assertSame('Dept123', $body['departmentId']);
        $this->assertSame(['productId' => 'PRODUCTA', 'value' => 15.0, 'quantity' => 1], $body['lineItems'][0]);
    }

    public function testOrderRequestSendsLineItemsAsAListWhateverTheirKeys(): void
    {
        $request = new OrderRequest(
            'bearer-abc',
            Order::TYPE_LINKS,
            'guid-123',
            [1 => new OrderRequestLineItem('PRODUCTA', 10, 1), 'b' => new OrderRequestLineItem('PRODUCTB', 20, 1)]
        );

        $this->assertStringContainsString(
            '"lineItems":[{"productId":"PRODUCTA","value":10.0,"quantity":1},'
            . '{"productId":"PRODUCTB","value":20.0,"quantity":1}]',
            (string)$request->getBody()
        );
    }

    public function testGetOrderRequestEncodesTheId(): void
    {
        $request = new GetOrderRequest('bearer-abc', 'EX/100002');

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('https://stage.api.yourdigitalreward.com/v1/Orders/EX%2F100002', (string)$request->getUri());
        $this->assertSame(OrderResponse::class, $request->getResponseObject());
    }

    public function testLinksOrderResponseExposesClaimLinks(): void
    {
        $order = (new OrderResponse(new Response(201, [], $this->fixture('links-order.json'))))->getOrder();

        $this->assertSame('EX-100002', $order->getId());
        $this->assertSame('EX-789-123', $order->getPoNumber());
        $this->assertSame(Order::STATUS_COMPLETED, $order->getStatus());
        $this->assertSame(Order::TYPE_LINKS, $order->getType());
        $this->assertSame('USD', $order->getCurrencyCode());
        $this->assertTrue($order->isFulfilled());
        $this->assertSame(['https://example.com/xxxxx/yyyyyyy/zzzzzz'], $order->getClaimLinks());

        $lineItem = $order->getLineItems()[0];
        $this->assertSame('EX-100002_0', $lineItem->getId());
        $this->assertSame('PRODUCTA', $lineItem->getProductId());
        $this->assertSame(15.0, $lineItem->getValue());
        $this->assertSame(1, $lineItem->getQuantity());
        $this->assertSame(15.0, $lineItem->getCost());
        $this->assertSame('ABC123', $lineItem->getClaimData()[0]->getClaimLinkChallengeAnswer());
    }

    public function testCodesOrderResponseExposesCodesPerCard(): void
    {
        $order = (new OrderResponse(new Response(201, [], $this->fixture('codes-order.json'))))->getOrder();

        $this->assertTrue($order->isFulfilled());
        $this->assertSame([], $order->getClaimLinks());
        $claimData = $order->getLineItems()[0]->getClaimData();
        $this->assertCount(3, $claimData);
        $this->assertSame(
            [['label' => 'Gift Card Number', 'value' => '1234 5678 9012 3451'], ['label' => 'PIN', 'value' => '1231']],
            $claimData[0]->getCodes()
        );
    }

    public function testCompletedOrderWithPendingLineItemIsNotFulfilled(): void
    {
        $data = json_decode($this->fixture('links-order.json'), true);
        $data['lineItems'][0]['status'] = 'Pending';

        $order = (new OrderResponse(new Response(201, [], json_encode($data))))->getOrder();

        $this->assertSame(Order::STATUS_COMPLETED, $order->getStatus());
        $this->assertFalse($order->isFulfilled());
    }

    public function testLineItemMissingCardsIsNotFulfilled(): void
    {
        $data = json_decode($this->fixture('links-order.json'), true);
        $data['lineItems'][0]['quantity'] = 2;

        $order = (new OrderResponse(new Response(201, [], json_encode($data))))->getOrder();

        $this->assertFalse($order->isFulfilled());
    }

    public function testPendingOrderIsNotFulfilled(): void
    {
        $data = json_decode($this->fixture('links-order.json'), true);
        $data['status'] = 'Pending';

        $order = (new OrderResponse(new Response(201, [], json_encode($data))))->getOrder();

        $this->assertFalse($order->isFulfilled());
    }

    public function testDuplicatePoNumberRaisesConflictWithOriginalOrderIds(): void
    {
        try {
            new OrderResponse(new Response(409, [], '{"poNumber":"guid-123","previousOrderIds":["EX-100002"]}'));
            $this->fail('Expected ConflictingOrderException');
        } catch (ConflictingOrderException $e) {
            $this->assertSame(409, $e->getStatusCode());
            $this->assertSame('guid-123', $e->getPoNumber());
            $this->assertSame(['EX-100002'], $e->getPreviousOrderIds());
            $this->assertSame('NeoCurrency already has order(s) EX-100002 for PO guid-123', $e->getMessage());
        }
    }

    public function testInsufficientFundsRaisesBalanceAndCost(): void
    {
        try {
            new OrderResponse(new Response(422, [], '{"availableBalance":1000,"orderCost":1200.5}'));
            $this->fail('Expected InsufficientFundsException');
        } catch (InsufficientFundsException $e) {
            $this->assertSame(422, $e->getStatusCode());
            $this->assertSame(1000.0, $e->getAvailableBalance());
            $this->assertSame(1200.5, $e->getOrderCost());
            $this->assertSame(
                'NeoCurrency insufficient funds: order costs 1200.50, available 1000.00',
                $e->getMessage()
            );
        }
    }

    public function testValidationErrorsAreListedPerProperty(): void
    {
        $body = '{"errors":[{"property":"lineItems[0].value","errors":["Must be a valid denomination."]},'
            . '{"property":"poNumber","errors":["Required.","Too long."]}]}';
        try {
            new OrderResponse(new Response(400, [], $body));
            $this->fail('Expected ValidationException');
        } catch (ValidationException $e) {
            $this->assertSame(400, $e->getStatusCode());
            $this->assertSame(
                ['lineItems[0].value' => ['Must be a valid denomination.'], 'poNumber' => ['Required.', 'Too long.']],
                $e->getErrors()
            );
            $this->assertSame(
                'NeoCurrency rejected the request: lineItems[0].value: Must be a valid denomination.; '
                . 'poNumber: Required., Too long.',
                $e->getMessage()
            );
        }
    }

    public function testUnexpectedErrorBodyFallsBackToApiException(): void
    {
        try {
            new OrderResponse(new Response(409, [], 'conflict'));
            $this->fail('Expected ApiException');
        } catch (ApiException $e) {
            $this->assertNotInstanceOf(ConflictingOrderException::class, $e);
            $this->assertSame('NeoCurrency returned HTTP 409 Conflict for ' . OrderResponse::class, $e->getMessage());
        }
    }

    public function testServerErrorRaisesApiException(): void
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionCode(504);

        new OrderResponse(new Response(504, [], ''));
    }

    private function fixture(string $name): string
    {
        return file_get_contents(__DIR__ . '/../fixtures/' . $name);
    }
}
