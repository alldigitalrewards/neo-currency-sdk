<?php

namespace AllDigitalRewards\NeoCurrency;

use Exception;
use Psr\Http\Message\ResponseInterface;
use stdClass;

abstract class AbstractResponse extends AbstractEntity
{
    /**
     * @throws Exception
     */
    public function __construct(ResponseInterface $response)
    {
        $data = json_decode($response->getBody(), true);
        $this->evaluateErrorsIfExists($data);
        return $this->extractData($data);
    }

    /**
     * @throws Exception
     */
    public function evaluateErrorsIfExists($data)
    {
        if (!empty($data['errors'])) {
            if (!is_array($data['errors'])) {
                $error = $data['errors'];
            } else {
                $error = implode(', ', $this->getError($data['errors']));
            }
            throw new Exception($error);
        }
    }

    abstract public function extractData(array $data): AbstractResponse;

    public function getError($errors): array
    {
        $flat = [];
        foreach($errors as $value) {
            if (is_array($value)) {
                $flat = array_merge($flat, $this->getError($value));
            }
            else {
                $flat[] = $value;
            }
        }
        return $flat;
    }
}