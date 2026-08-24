<?php

namespace Leal\Cards\Requests;

use Leal\Core\Json\JsonSerializableType;
use Leal\Cards\Types\CreateCardsRequestCard;
use Leal\Core\Json\JsonProperty;

class CreateCardsRequest extends JsonSerializableType
{
    /**
     * @var CreateCardsRequestCard $card
     */
    #[JsonProperty('card')]
    public CreateCardsRequestCard $card;

    /**
     * @param array{
     *   card: CreateCardsRequestCard,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->card = $values['card'];
    }
}
