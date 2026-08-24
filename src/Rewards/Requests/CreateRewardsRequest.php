<?php

namespace Leal\Rewards\Requests;

use Leal\Core\Json\JsonSerializableType;
use Leal\Rewards\Types\CreateRewardsRequestReward;
use Leal\Core\Json\JsonProperty;

class CreateRewardsRequest extends JsonSerializableType
{
    /**
     * @var CreateRewardsRequestReward $reward
     */
    #[JsonProperty('reward')]
    public CreateRewardsRequestReward $reward;

    /**
     * @param array{
     *   reward: CreateRewardsRequestReward,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->reward = $values['reward'];
    }
}
