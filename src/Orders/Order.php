<?php

namespace AllDigitalRewards\NeoCurrency\Orders;

use AllDigitalRewards\NeoCurrency\AbstractEntity;

class Order extends AbstractEntity
{
    public const TYPE_LINKS = 'Links';
    public const TYPE_CODES = 'Codes';
    public const TYPE_DIGITAL_DELIVERY = 'DigitalDelivery';
    public const STATUS_PENDING = 'Pending';
    public const STATUS_PROCESSING = 'Processing';
    public const STATUS_AWAITING_APPROVAL = 'AwaitingApproval';
    public const STATUS_COMPLETED = 'Completed';
    public const STATUS_CANCELLED = 'Cancelled';

    protected string $id = '';
    protected ?string $timestamp = null;
    protected ?string $status = null;
    protected ?string $type = null;
    protected string $poNumber = '';
    protected ?string $currencyCode = null;
    protected ?string $departmentId = null;
    protected array $lineItems = [];

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getTimestamp(): ?string
    {
        return $this->timestamp;
    }

    public function setTimestamp(string $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getPoNumber(): string
    {
        return $this->poNumber;
    }

    public function setPoNumber(string $poNumber): void
    {
        $this->poNumber = $poNumber;
    }

    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    public function setCurrencyCode(string $currencyCode): void
    {
        $this->currencyCode = $currencyCode;
    }

    public function getDepartmentId(): ?string
    {
        return $this->departmentId;
    }

    public function setDepartmentId(string $departmentId): void
    {
        $this->departmentId = $departmentId;
    }

    /**
     * @return LineItem[]
     */
    public function getLineItems(): array
    {
        return $this->lineItems;
    }

    public function setLineItems(array $lineItems): void
    {
        $this->lineItems = array_map(fn(array $lineItem) => new LineItem($lineItem), $lineItems);
    }

    public function isFulfilled(): bool
    {
        if ($this->status !== self::STATUS_COMPLETED || empty($this->lineItems)) {
            return false;
        }
        foreach ($this->lineItems as $lineItem) {
            if (!$lineItem->isFulfilled()) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return string[]
     */
    public function getClaimLinks(): array
    {
        $claimLinks = [];
        foreach ($this->lineItems as $lineItem) {
            foreach ($lineItem->getClaimData() as $claimData) {
                if ($claimData->getClaimLink() !== null) {
                    $claimLinks[] = $claimData->getClaimLink();
                }
            }
        }
        return $claimLinks;
    }
}
