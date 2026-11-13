<?php

namespace AllDigitalRewards\NeoCurrency\Products;

use AllDigitalRewards\NeoCurrency\AbstractEntity;

class Product extends AbstractEntity
{
    public const TYPE_DIGITAL = 'Digital';
    public const TYPE_PHYSICAL = 'Physical';
    public const DENOMINATION_FIXED = 'Fixed';
    public const DENOMINATION_VARIABLE = 'Variable';
    public const DENOMINATION_VARIABLE_NO_CENTS = 'VariableNoCents';

    protected string $id = '';
    protected string $name = '';
    protected array $denominations = [];
    protected ?string $denominationType = null;
    protected ?string $type = null;
    protected ?string $shortDescription = null;
    protected ?string $longDescription = null;
    protected ?string $terms = null;
    protected ?string $disclaimer = null;
    protected ?string $redemptionNote = null;
    protected ?string $currencyCode = null;
    protected array $cultureCodes = [];
    protected array $media = [];
    protected array $translations = [];

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float[]
     */
    public function getDenominations(): array
    {
        return $this->denominations;
    }

    public function setDenominations(array $denominations): void
    {
        $this->denominations = array_map('floatval', $denominations);
    }

    public function getDenominationType(): ?string
    {
        return $this->denominationType;
    }

    public function setDenominationType(string $denominationType): void
    {
        $this->denominationType = $denominationType;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    public function getLongDescription(): ?string
    {
        return $this->longDescription;
    }

    public function setLongDescription(string $longDescription): void
    {
        $this->longDescription = $longDescription;
    }

    public function getTerms(): ?string
    {
        return $this->terms;
    }

    public function setTerms(string $terms): void
    {
        $this->terms = $terms;
    }

    public function getDisclaimer(): ?string
    {
        return $this->disclaimer;
    }

    public function setDisclaimer(string $disclaimer): void
    {
        $this->disclaimer = $disclaimer;
    }

    public function getRedemptionNote(): ?string
    {
        return $this->redemptionNote;
    }

    public function setRedemptionNote(string $redemptionNote): void
    {
        $this->redemptionNote = $redemptionNote;
    }

    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    public function setCurrencyCode(string $currencyCode): void
    {
        $this->currencyCode = $currencyCode;
    }

    public function getCultureCodes(): array
    {
        return $this->cultureCodes;
    }

    public function setCultureCodes(array $cultureCodes): void
    {
        $this->cultureCodes = $cultureCodes;
    }

    public function getMedia(): array
    {
        return $this->media;
    }

    public function setMedia(array $media): void
    {
        $this->media = $media;
    }

    public function getFaceplatePath(): ?string
    {
        return $this->media['faceplates'][0]['path'] ?? null;
    }

    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function setTranslations(array $translations): void
    {
        $this->translations = $translations;
    }
}
