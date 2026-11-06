<?php

namespace Leal\CustomerCards\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class GetCustomerCardsResponseReferredBy extends JsonSerializableType
{
    /**
     * @var float $customerCardId The inviting customer's card
     */
    #[JsonProperty('customer_card_id')]
    public float $customerCardId;

    /**
     * @var int $customerId The customer who invited them
     */
    #[JsonProperty('customer_id')]
    public int $customerId;

    /**
     * @var float $referralId Referral ID
     */
    #[JsonProperty('referral_id')]
    public float $referralId;

    /**
     * @var string $rewardedAt ISO 8601 timestamp the referral paid out
     */
    #[JsonProperty('rewarded_at')]
    public string $rewardedAt;

    /**
     * @var string $status 'pending' until the store first stamps this card for a visit, then 'rewarded'
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @param array{
     *   customerCardId: float,
     *   customerId: int,
     *   referralId: float,
     *   rewardedAt: string,
     *   status: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->customerCardId = $values['customerCardId'];
        $this->customerId = $values['customerId'];
        $this->referralId = $values['referralId'];
        $this->rewardedAt = $values['rewardedAt'];
        $this->status = $values['status'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
