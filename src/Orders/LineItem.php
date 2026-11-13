<?php

namespace AllDigitalRewards\NeoCurrency\Orders;

use AllDigitalRewards\NeoCurrency\AbstractEntity;

class LineItem extends AbstractEntity
{
    public const STATUS_PENDING = 'Pending';
    public const STATUS_CANCELLED = 'Cancelled';

    protected string $id = '';
    protected ?string $status = null;
    protected string $productId = '';
    protected float $value = 0;
    protected int $quantity = 0;
    protected ?float $cost = null;
    protected ?string $externalId = null;
    protected array $claimData = [];

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function setProductId(string $productId): void
    {
        $this->productId = $productId;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(float $cost): void
    {
        $this->cost = $cost;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): void
    {
        $this->externalId = $externalId;
    }

    /**
     * @return ClaimData[]
     */
    public function getClaimData(): array
    {
        return $this->claimData;
    }

    public function setClaimData(array $claimData): void
    {
        $this->claimData = array_map(fn(array $card) => new ClaimData($card), $claimData);
    }

    public function isFulfilled(): bool
    {
        $isSettled = !in_array($this->status, [null, self::STATUS_PENDING, self::STATUS_CANCELLED], true);
        return $isSettled && count($this->claimData) >= max(1, $this->quantity);
    }
}
