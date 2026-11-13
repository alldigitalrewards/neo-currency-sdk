<?php

namespace AllDigitalRewards\NeoCurrency\Exceptions;

class ValidationException extends ApiException
{
    private array $errors = [];

    public function __construct(array $validationErrors)
    {
        foreach ($validationErrors as $validationError) {
            $this->errors[(string)($validationError['property'] ?? '')] = (array)($validationError['errors'] ?? []);
        }
        $descriptions = [];
        foreach ($this->errors as $property => $messages) {
            $descriptions[] = $property . ': ' . implode(', ', $messages);
        }
        parent::__construct('NeoCurrency rejected the request: ' . implode('; ', $descriptions), 400);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
