<?php

namespace AllDigitalRewards\NeoCurrency;

use AllDigitalRewards\NeoCurrency\Exceptions\ApiException;
use AllDigitalRewards\NeoCurrency\Exceptions\ConflictingOrderException;
use AllDigitalRewards\NeoCurrency\Exceptions\InsufficientFundsException;
use AllDigitalRewards\NeoCurrency\Exceptions\ValidationException;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractResponse extends AbstractEntity
{
    /**
     * @throws ApiException
     */
    public function __construct(ResponseInterface $response)
    {
        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            throw $this->makeApiException($response);
        }
        $this->extractData($this->decodeBody($response));
    }

    private function makeApiException(ResponseInterface $response): ApiException
    {
        $status = $response->getStatusCode();
        $data = json_decode((string)$response->getBody(), true);

        if ($status === 400 && is_array($data['errors'] ?? null)) {
            return new ValidationException($data['errors']);
        }
        if ($status === 409 && is_array($data['previousOrderIds'] ?? null)) {
            return new ConflictingOrderException((string)($data['poNumber'] ?? ''), $data['previousOrderIds']);
        }
        if ($status === 422 && isset($data['availableBalance'], $data['orderCost'])) {
            return new InsufficientFundsException((float)$data['availableBalance'], (float)$data['orderCost']);
        }

        return new ApiException(
            sprintf('NeoCurrency returned HTTP %d %s for %s', $status, $response->getReasonPhrase(), static::class),
            $status
        );
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
