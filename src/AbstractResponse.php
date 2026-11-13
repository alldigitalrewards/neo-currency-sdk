<?php

namespace AllDigitalRewards\NeoCurrency;

use AllDigitalRewards\NeoCurrency\Exceptions\ApiException;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractResponse extends AbstractEntity
{
    /**
     * @throws ApiException
     */
    public function __construct(ResponseInterface $response)
    {
        if ($response->getStatusCode() >= 400) {
            throw ApiException::fromResponse($response, static::class);
        }
        $this->extractData($this->decodeBody($response));
    }

    /**
     * @throws ApiException
     */
    protected function decodeBody(ResponseInterface $response): array
    {
        $data = json_decode((string)$response->getBody(), true);
        if (!is_array($data)) {
            throw new ApiException(
                sprintf(
                    'NeoCurrency returned a non-JSON %s (HTTP %d %s)',
                    static::class,
                    $response->getStatusCode(),
                    $response->getReasonPhrase()
                ),
                $response->getStatusCode()
            );
        }
        return $data;
    }

    /**
     * @throws ApiException
     */
    abstract public function extractData(array $data): AbstractResponse;
}
