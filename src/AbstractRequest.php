<?php

namespace AllDigitalRewards\NeoCurrency;

use GuzzleHttp\Psr7\Request;

abstract class AbstractRequest extends Request implements HasResponse
{
    protected function apiUrl(string $path, array $query = []): string
    {
        $isProduction = strtolower((string)getenv('ENVIRONMENT')) === 'production';
        $url = ($isProduction
            ? 'https://api.yourdigitalreward.com/v1'
            : 'https://stage.api.yourdigitalreward.com/v1') . $path;
        $query = array_filter($query, fn($value) => $value !== null);

        return empty($query) ? $url : $url . '?' . http_build_query($query);
    }

    protected function bearerHeaders(string $bearerToken): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $bearerToken,
        ];
    }
}
