<?php

namespace AllDigitalRewards\NeoCurrency\Exceptions;

class ConflictingOrderException extends ApiException
{
    public function __construct(private readonly string $poNumber, private readonly array $previousOrderIds)
    {
        parent::__construct(
            sprintf('NeoCurrency already has order(s) %s for PO %s', implode(', ', $previousOrderIds), $poNumber),
            409
        );
    }

    public function getPoNumber(): string
    {
        return $this->poNumber;
    }

    public function getPreviousOrderIds(): array
    {
        return $this->previousOrderIds;
    }
}
