<?php

namespace Leal\CustomerCards\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class RedeemCustomerCardsResponseRedemption extends JsonSerializableType
{
    /**
     * @var int $id Redemption ID
     */
    #[JsonProperty('id')]
    public int $id;

    /**
     * @var string $redeemedAt ISO 8601 timestamp of the redemption
     */
    #[JsonProperty('redeemed_at')]
    public string $redeemedAt;

    /**
     * @var int $rewardId Reward that was redeemed
     */
    #[JsonProperty('reward_id')]
    public int $rewardId;

    /**
     * @var string $rewardName Display name of the reward
     */
    #[JsonProperty('reward_name')]
    public string $rewardName;

    /**
     * @var int $stampsRemaining Stamps left on the card afterwards
     */
    #[JsonProperty('stamps_remaining')]
    public int $stampsRemaining;

    /**
     * @var int $stampsSpent Stamps deducted from the card
     */
    #[JsonProperty('stamps_spent')]
    public int $stampsSpent;

    /**
     * @param array{
     *   id: int,
     *   redeemedAt: string,
     *   rewardId: int,
     *   rewardName: string,
     *   stampsRemaining: int,
     *   stampsSpent: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->redeemedAt = $values['redeemedAt'];
        $this->rewardId = $values['rewardId'];
        $this->rewardName = $values['rewardName'];
        $this->stampsRemaining = $values['stampsRemaining'];
        $this->stampsSpent = $values['stampsSpent'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
