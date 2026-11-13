<?php

namespace AllDigitalRewards\NeoCurrency\Status;

use AllDigitalRewards\NeoCurrency\AbstractResponse;
use Psr\Http\Message\ResponseInterface;

class StatusResponse extends AbstractResponse
{
    protected function decodeBody(ResponseInterface $response): array
    {
        return [];
    }

    public function extractData(array $data): AbstractResponse
    {
        return $this;
    }
}
