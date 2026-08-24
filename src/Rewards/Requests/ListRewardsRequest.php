<?php

namespace Leal\Rewards\Requests;

use Leal\Core\Json\JsonSerializableType;

class ListRewardsRequest extends JsonSerializableType
{
    /**
     * @var ?int $cardId Filter rewards belonging to a specific card
     */
    public ?int $cardId;

    /**
     * @var ?string $active When present, return only active rewards
     */
    public ?string $active;

    /**
     * @param array{
     *   cardId?: ?int,
     *   active?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->cardId = $values['cardId'] ?? null;
        $this->active = $values['active'] ?? null;
    }
}
