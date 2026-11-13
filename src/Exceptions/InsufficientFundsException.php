<?php

namespace AllDigitalRewards\NeoCurrency\Exceptions;

class InsufficientFundsException extends ApiException
{
    public function __construct(private readonly float $availableBalance, private readonly float $orderCost)
    {
        parent::__construct(
            sprintf('NeoCurrency insufficient funds: order costs %.2f, available %.2f', $orderCost, $availableBalance),
            422
        );
    }

    public function getAvailableBalance(): float
    {
        return $this->availableBalance;
    }

    public function getOrderCost(): float
    {
        return $this->orderCost;
    }
}
