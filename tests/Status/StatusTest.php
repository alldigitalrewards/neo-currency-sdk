<?php

namespace AllDigitalRewards\Tests\Status;

use AllDigitalRewards\NeoCurrency\Exceptions\ApiException;
use AllDigitalRewards\NeoCurrency\Status\StatusRequest;
use AllDigitalRewards\NeoCurrency\Status\StatusResponse;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class StatusTest extends TestCase
{
    public function testStatusRequestHitsStatusEndpoint(): void
    {
        $request = new StatusRequest('bearer-abc');

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('https://stage.api.yourdigitalreward.com/v1/Status', (string)$request->getUri());
        $this->assertSame('Bearer bearer-abc', $request->getHeaderLine('Authorization'));
        $this->assertSame(StatusResponse::class, $request->getResponseObject());
    }

    public function testEmptyOkBodyMeansConnected(): void
    {
        $this->assertInstanceOf(StatusResponse::class, new StatusResponse(new Response(200, [], '')));
    }

    public function testRedirectIsNotTreatedAsHealthy(): void
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionCode(302);
        $this->expectExceptionMessage('NeoCurrency returned HTTP 302 Found for ' . StatusResponse::class);

        new StatusResponse(new Response(302, ['Location' => '/500'], ''));
    }

    public function testInformationalStatusIsNotTreatedAsHealthy(): void
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionCode(100);

        new StatusResponse(new Response(100, [], ''));
    }

    public function testUnauthorizedRaisesApiException(): void
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionCode(401);

        new StatusResponse(new Response(401, [], ''));
    }
}
