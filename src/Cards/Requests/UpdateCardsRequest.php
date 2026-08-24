<?php

namespace Leal\Cards\Requests;

use Leal\Core\Json\JsonSerializableType;
use Leal\Cards\Types\UpdateCardsRequestCard;
use Leal\Core\Json\JsonProperty;

class UpdateCardsRequest extends JsonSerializableType
{
    /**
     * @var UpdateCardsRequestCard $card
     */
    #[JsonProperty('card')]
    public UpdateCardsRequestCard $card;

    /**
     * @param array{
     *   card: UpdateCardsRequestCard,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->card = $values['card'];
    }
}
