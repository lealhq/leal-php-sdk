<?php

namespace Leal\Rewards\Requests;

use Leal\Core\Json\JsonSerializableType;
use Leal\Rewards\Types\UpdateRewardsRequestReward;
use Leal\Core\Json\JsonProperty;

class UpdateRewardsRequest extends JsonSerializableType
{
    /**
     * @var UpdateRewardsRequestReward $reward
     */
    #[JsonProperty('reward')]
    public UpdateRewardsRequestReward $reward;

    /**
     * @param array{
     *   reward: UpdateRewardsRequestReward,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->reward = $values['reward'];
    }
}
