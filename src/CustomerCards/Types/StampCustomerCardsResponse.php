<?php

namespace Leal\CustomerCards\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;
use Leal\Core\Types\ArrayType;

class StampCustomerCardsResponse extends JsonSerializableType
{
    /**
     * @var int $accountId Parent store ID
     */
    #[JsonProperty('account_id')]
    public int $accountId;

    /**
     * @var string $appleWalletUrl Link to add or view the pass in Apple Wallet
     */
    #[JsonProperty('apple_wallet_url')]
    public string $appleWalletUrl;

    /**
     * @var array<string> $availableRewards Rewards this customer can redeem right now
     */
    #[JsonProperty('available_rewards'), ArrayType(['string'])]
    public array $availableRewards;

    /**
     * @var int $cardId Loyalty card template ID
     */
    #[JsonProperty('card_id')]
    public int $cardId;

    /**
     * @var string $cardName Name of the loyalty card
     */
    #[JsonProperty('card_name')]
    public string $cardName;

    /**
     * @var string $createdAt ISO 8601 creation timestamp
     */
    #[JsonProperty('created_at')]
    public string $createdAt;

    /**
     * @var int $customerId Owning customer ID
     */
    #[JsonProperty('customer_id')]
    public int $customerId;

    /**
     * @var string $googleWalletUrl Link to add or view the pass in Google Wallet
     */
    #[JsonProperty('google_wallet_url')]
    public string $googleWalletUrl;

    /**
     * @var int $id Customer card ID
     */
    #[JsonProperty('id')]
    public int $id;

    /**
     * @var string $issuedAt ISO 8601 timestamp the card was issued
     */
    #[JsonProperty('issued_at')]
    public string $issuedAt;

    /**
     * @var bool $passInstalled Whether the wallet pass has been installed
     */
    #[JsonProperty('pass_installed')]
    public bool $passInstalled;

    /**
     * @var float $progressPercentage Completion towards the next reward, 0 to 100
     */
    #[JsonProperty('progress_percentage')]
    public float $progressPercentage;

    /**
     * @var int $stampsCount Stamps collected so far
     */
    #[JsonProperty('stamps_count')]
    public int $stampsCount;

    /**
     * @var int $stampsRemaining Stamps still needed to complete the card
     */
    #[JsonProperty('stamps_remaining')]
    public int $stampsRemaining;

    /**
     * @var string $status Current state of the customer card
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @var string $updatedAt ISO 8601 last-update timestamp
     */
    #[JsonProperty('updated_at')]
    public string $updatedAt;

    /**
     * @var string $uuid Public identifier used in wallet pass URLs
     */
    #[JsonProperty('uuid')]
    public string $uuid;

    /**
     * @param array{
     *   accountId: int,
     *   appleWalletUrl: string,
     *   availableRewards: array<string>,
     *   cardId: int,
     *   cardName: string,
     *   createdAt: string,
     *   customerId: int,
     *   googleWalletUrl: string,
     *   id: int,
     *   issuedAt: string,
     *   passInstalled: bool,
     *   progressPercentage: float,
     *   stampsCount: int,
     *   stampsRemaining: int,
     *   status: string,
     *   updatedAt: string,
     *   uuid: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->accountId = $values['accountId'];
        $this->appleWalletUrl = $values['appleWalletUrl'];
        $this->availableRewards = $values['availableRewards'];
        $this->cardId = $values['cardId'];
        $this->cardName = $values['cardName'];
        $this->createdAt = $values['createdAt'];
        $this->customerId = $values['customerId'];
        $this->googleWalletUrl = $values['googleWalletUrl'];
        $this->id = $values['id'];
        $this->issuedAt = $values['issuedAt'];
        $this->passInstalled = $values['passInstalled'];
        $this->progressPercentage = $values['progressPercentage'];
        $this->stampsCount = $values['stampsCount'];
        $this->stampsRemaining = $values['stampsRemaining'];
        $this->status = $values['status'];
        $this->updatedAt = $values['updatedAt'];
        $this->uuid = $values['uuid'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
