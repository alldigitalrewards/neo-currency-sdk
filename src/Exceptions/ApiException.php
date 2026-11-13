<?php

namespace AllDigitalRewards\NeoCurrency\Exceptions;

use Exception;

class ApiException extends Exception
{
    public function getStatusCode(): int
    {
        return $this->getCode();
    }
}
