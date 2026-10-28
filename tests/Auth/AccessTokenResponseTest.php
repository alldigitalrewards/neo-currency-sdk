<?php

namespace AllDigitalRewards\Tests\Auth;

use AllDigitalRewards\NeoCurrency\Auth\AccessTokenResponse;
use Exception;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AccessTokenResponseTest extends TestCase
{
    public static function nonJsonResponses(): array
    {
        return [
            'html bad gateway' => [502, '<html><body><h1>502 Bad Gateway</h1></body></html>', 'HTTP 502 Bad Gateway'],
            'html forbidden' => [403, '<!DOCTYPE html><title>Attention Required!</title>', 'HTTP 403 Forbidden'],
            'empty ok' => [200, '', 'HTTP 200 OK'],
        ];
    }

    #[DataProvider('nonJsonResponses')]
    public function testNonJsonBodyReportsTheHttpStatus(int $status, string $body, string $expectedStatus): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage(
            'NeoCurrency returned a non-JSON ' . AccessTokenResponse::class . " ($expectedStatus)"
        );

        new AccessTokenResponse(new Response($status, [], $body));
    }

    public function testJsonErrorKeepsNeoCurrencyMessage(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Unauthorized access');

        new AccessTokenResponse(new Response(401, [], '{"errors":"Unauthorized access"}'));
    }
}
