<?php

namespace AllDigitalRewards\Tests\Auth;

use AllDigitalRewards\NeoCurrency\Auth\TokenRequest;
use AllDigitalRewards\NeoCurrency\Auth\TokenResponse;
use AllDigitalRewards\NeoCurrency\Exceptions\ApiException;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class TokenTest extends TestCase
{
    protected function tearDown(): void
    {
        putenv('ENVIRONMENT');
    }

    public function testTokenRequestSendsCredentialHeadersToStage(): void
    {
        $request = new TokenRequest('api@example.com', 'access-token-1');

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('https://stage.api.yourdigitalreward.com/v1/Tokens', (string)$request->getUri());
        $this->assertSame('api@example.com', $request->getHeaderLine('Email'));
        $this->assertSame('access-token-1', $request->getHeaderLine('AccessToken'));
        $this->assertFalse($request->hasHeader('Authorization'));
        $this->assertSame(TokenResponse::class, $request->getResponseObject());
    }

    public function testTokenRequestTargetsProductionWhenEnvironmentIsProduction(): void
    {
        putenv('ENVIRONMENT=production');

        $request = new TokenRequest('api@example.com', 'access-token-1');

        $this->assertSame('https://api.yourdigitalreward.com/v1/Tokens', (string)$request->getUri());
    }

    public function testTokenResponseExposesBearerValueAndLifetime(): void
    {
        $response = new TokenResponse(new Response(200, [], '{"value":"bearer-abc","expiresIn":60}'));

        $this->assertSame('bearer-abc', $response->getValue());
        $this->assertSame(60, $response->getExpiresIn());
    }

    public function testTokenResponseWithoutValueFails(): void
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionMessage('NeoCurrency returned no bearer token');

        new TokenResponse(new Response(200, [], '{"expiresIn":60}'));
    }

    public function testDisabledAccountRaisesApiExceptionWithStatus(): void
    {
        try {
            new TokenResponse(new Response(403, [], ''));
            $this->fail('Expected ApiException');
        } catch (ApiException $e) {
            $this->assertSame(403, $e->getStatusCode());
            $this->assertSame(
                'NeoCurrency returned HTTP 403 Forbidden for ' . TokenResponse::class,
                $e->getMessage()
            );
        }
    }

    public function testNonJsonSuccessBodyReportsTheHttpStatus(): void
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionMessage('NeoCurrency returned a non-JSON ' . TokenResponse::class . ' (HTTP 200 OK)');

        new TokenResponse(new Response(200, [], '<html>maintenance</html>'));
    }
}
