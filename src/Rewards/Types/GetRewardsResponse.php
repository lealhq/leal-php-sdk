<?php

namespace Leal\Rewards\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class GetRewardsResponse extends JsonSerializableType
{
    /**
     * @var int $accountId Parent store ID
     */
    #[JsonProperty('account_id')]
    public int $accountId;

    /**
     * @var bool $active Whether the reward can currently be redeemed
     */
    #[JsonProperty('active')]
    public bool $active;

    /**
     * @var int $cardId ID of the loyalty card this reward belongs to
     */
    #[JsonProperty('card_id')]
    public int $cardId;

    /**
     * @var string $createdAt ISO 8601 creation timestamp
     */
    #[JsonProperty('created_at')]
    public string $createdAt;

    /**
     * @var string $description Longer description of the reward
     */
    #[JsonProperty('description')]
    public string $description;

    /**
     * @var int $id Unique reward ID
     */
    #[JsonProperty('id')]
    public int $id;

    /**
     * @var string $name Display name of the reward
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var int $position Display order
     */
    #[JsonProperty('position')]
    public int $position;

    /**
     * @var int $stampsRequired Stamps needed before the reward can be redeemed
     */
    #[JsonProperty('stamps_required')]
    public int $stampsRequired;

    /**
     * @var string $updatedAt ISO 8601 last-update timestamp
     */
    #[JsonProperty('updated_at')]
    public string $updatedAt;

    /**
     * @param array{
     *   accountId: int,
     *   active: bool,
     *   cardId: int,
     *   createdAt: string,
     *   description: string,
     *   id: int,
     *   name: string,
     *   position: int,
     *   stampsRequired: int,
     *   updatedAt: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->accountId = $values['accountId'];
        $this->active = $values['active'];
        $this->cardId = $values['cardId'];
        $this->createdAt = $values['createdAt'];
        $this->description = $values['description'];
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->position = $values['position'];
        $this->stampsRequired = $values['stampsRequired'];
        $this->updatedAt = $values['updatedAt'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
