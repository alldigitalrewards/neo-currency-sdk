<?php

namespace AllDigitalRewards\NeoCurrency\Exceptions;

use Exception;
use Psr\Http\Message\ResponseInterface;

class ApiException extends Exception
{
    public static function fromResponse(ResponseInterface $response, string $responseClass): self
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

        return new self(
            sprintf('NeoCurrency returned HTTP %d %s for %s', $status, $response->getReasonPhrase(), $responseClass),
            $status
        );
    }

    public function getStatusCode(): int
    {
        return $this->getCode();
    }
}
