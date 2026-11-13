<?php

namespace AllDigitalRewards\NeoCurrency;

use GuzzleHttp\Psr7\Request;

abstract class AbstractRequest extends Request implements HasResponse
{
    private const PRODUCTION_API_URL = 'https://api.yourdigitalreward.com/v1';
    private const STAGE_API_URL = 'https://stage.api.yourdigitalreward.com/v1';

    protected static function apiUrl(string $path, array $query = []): string
    {
        $isProduction = strtolower((string)getenv('ENVIRONMENT')) === 'production';
        $url = ($isProduction ? self::PRODUCTION_API_URL : self::STAGE_API_URL) . $path;
        $query = array_filter($query, fn($value) => $value !== null);

        return empty($query) ? $url : $url . '?' . http_build_query($query);
    }

    protected static function bearerHeaders(string $bearerToken): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $bearerToken,
        ];
    }
}
