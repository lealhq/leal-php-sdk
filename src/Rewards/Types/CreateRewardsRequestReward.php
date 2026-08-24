<?php

namespace Leal\Rewards\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class CreateRewardsRequestReward extends JsonSerializableType
{
    /**
     * @var ?bool $active Whether the reward is active and redeemable (defaults to true)
     */
    #[JsonProperty('active')]
    public ?bool $active;

    /**
     * @var int $cardId ID of the loyalty card this reward belongs to
     */
    #[JsonProperty('card_id')]
    public int $cardId;

    /**
     * @var ?string $description Detailed description of the reward
     */
    #[JsonProperty('description')]
    public ?string $description;

    /**
     * @var string $name Display name of the reward (e.g. 'Free Coffee')
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var ?int $position Display order position (lower numbers appear first)
     */
    #[JsonProperty('position')]
    public ?int $position;

    /**
     * @var int $stampsRequired Number of stamps needed to unlock this reward (must be > 0)
     */
    #[JsonProperty('stamps_required')]
    public int $stampsRequired;

    /**
     * @param array{
     *   cardId: int,
     *   name: string,
     *   stampsRequired: int,
     *   active?: ?bool,
     *   description?: ?string,
     *   position?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->active = $values['active'] ?? null;
        $this->cardId = $values['cardId'];
        $this->description = $values['description'] ?? null;
        $this->name = $values['name'];
        $this->position = $values['position'] ?? null;
        $this->stampsRequired = $values['stampsRequired'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
