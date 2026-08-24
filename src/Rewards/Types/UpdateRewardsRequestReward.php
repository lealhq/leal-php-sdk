<?php

namespace Leal\Rewards\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class UpdateRewardsRequestReward extends JsonSerializableType
{
    /**
     * @var ?bool $active Whether the reward is active and redeemable
     */
    #[JsonProperty('active')]
    public ?bool $active;

    /**
     * @var ?string $description Detailed description of the reward
     */
    #[JsonProperty('description')]
    public ?string $description;

    /**
     * @var ?string $name Display name of the reward
     */
    #[JsonProperty('name')]
    public ?string $name;

    /**
     * @var ?int $position Display order position
     */
    #[JsonProperty('position')]
    public ?int $position;

    /**
     * @var ?int $stampsRequired Number of stamps needed to unlock this reward (must be > 0)
     */
    #[JsonProperty('stamps_required')]
    public ?int $stampsRequired;

    /**
     * @param array{
     *   active?: ?bool,
     *   description?: ?string,
     *   name?: ?string,
     *   position?: ?int,
     *   stampsRequired?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->active = $values['active'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->position = $values['position'] ?? null;
        $this->stampsRequired = $values['stampsRequired'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
