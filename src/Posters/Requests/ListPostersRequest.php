<?php

namespace Leal\Posters\Requests;

use Leal\Core\Json\JsonSerializableType;

class ListPostersRequest extends JsonSerializableType
{
    /**
     * @var ?int $cardId Filter posters belonging to a specific card
     */
    public ?int $cardId;

    /**
     * @var ?string $active When present, return only active posters
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
