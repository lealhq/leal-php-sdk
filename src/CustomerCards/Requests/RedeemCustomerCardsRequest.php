<?php

namespace Leal\CustomerCards\Requests;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class RedeemCustomerCardsRequest extends JsonSerializableType
{
    /**
     * @var int $rewardId Reward ID to redeem
     */
    #[JsonProperty('reward_id')]
    public int $rewardId;

    /**
     * @param array{
     *   rewardId: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->rewardId = $values['rewardId'];
    }
}
