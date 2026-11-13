<?php

namespace AllDigitalRewards\NeoCurrency\Products;

use AllDigitalRewards\NeoCurrency\AbstractResponse;

class ProductsResponse extends AbstractResponse
{
    protected array $products = [];
    protected int $page = 1;
    protected int $pageSize = 0;
    protected int $totalCount = 0;

    public function extractData(array $data): AbstractResponse
    {
        foreach ($data['data'] ?? [] as $product) {
            $this->products[] = new Product($product);
        }
        $this->page = (int)($data['page'] ?? 1);
        $this->pageSize = (int)($data['pageSize'] ?? count($this->products));
        $this->totalCount = (int)($data['totalCount'] ?? count($this->products));
        return $this;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    public function hasMorePages(): bool
    {
        return $this->page * $this->pageSize < $this->totalCount;
    }
}
