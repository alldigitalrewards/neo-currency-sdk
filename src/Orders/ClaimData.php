<?php

namespace AllDigitalRewards\NeoCurrency\Orders;

use AllDigitalRewards\NeoCurrency\AbstractEntity;

class ClaimData extends AbstractEntity
{
    protected ?string $id = null;
    protected ?string $claimLink = null;
    protected ?string $claimLinkChallengeAnswer = null;
    protected array $codes = [];

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getClaimLink(): ?string
    {
        return $this->claimLink;
    }

    public function setClaimLink(string $claimLink): void
    {
        $this->claimLink = $claimLink;
    }

    public function getClaimLinkChallengeAnswer(): ?string
    {
        return $this->claimLinkChallengeAnswer;
    }

    public function setClaimLinkChallengeAnswer(string $claimLinkChallengeAnswer): void
    {
        $this->claimLinkChallengeAnswer = $claimLinkChallengeAnswer;
    }

    /**
     * @return array<int, array{label: ?string, value: ?string}>
     */
    public function getCodes(): array
    {
        return $this->codes;
    }

    public function setCodes(array $codes): void
    {
        $this->codes = $codes;
    }
}
