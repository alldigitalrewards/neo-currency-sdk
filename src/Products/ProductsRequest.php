<?php

namespace AllDigitalRewards\NeoCurrency\Products;

use AllDigitalRewards\NeoCurrency\AbstractRequest;

class ProductsRequest extends AbstractRequest
{
    public const MAX_PAGE_SIZE = 500;

    public function __construct(
        string $bearerToken,
        int $pageIndex = 1,
        int $pageSize = self::MAX_PAGE_SIZE,
        ?string $currencyCode = null,
        ?string $productType = null
    ) {
        parent::__construct(
            'GET',
            self::apiUrl('/Products', [
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'currencyCode' => $currencyCode,
                'productType' => $productType,
            ]),
            self::bearerHeaders($bearerToken)
        );
    }

    public function getResponseObject(): string
    {
        return ProductsResponse::class;
    }
}
