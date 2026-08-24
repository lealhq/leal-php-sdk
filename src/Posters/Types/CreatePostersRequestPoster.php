<?php

namespace Leal\Posters\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class CreatePostersRequestPoster extends JsonSerializableType
{
    /**
     * @var ?bool $active Whether the poster is active (defaults to true)
     */
    #[JsonProperty('active')]
    public ?bool $active;

    /**
     * @var int $cardId ID of the loyalty card this poster links to
     */
    #[JsonProperty('card_id')]
    public int $cardId;

    /**
     * @var ?string $paperSize Print size – one of: a4, a5, a6, letter
     */
    #[JsonProperty('paper_size')]
    public ?string $paperSize;

    /**
     * @var ?string $primaryColor Primary brand color as a hex string (e.g. '#FF5733')
     */
    #[JsonProperty('primary_color')]
    public ?string $primaryColor;

    /**
     * @var ?string $secondaryColor Secondary brand color as a hex string
     */
    #[JsonProperty('secondary_color')]
    public ?string $secondaryColor;

    /**
     * @var ?string $textColor Text color as a hex string
     */
    #[JsonProperty('text_color')]
    public ?string $textColor;

    /**
     * @var ?string $title Headline text displayed on the poster
     */
    #[JsonProperty('title')]
    public ?string $title;

    /**
     * @param array{
     *   cardId: int,
     *   active?: ?bool,
     *   paperSize?: ?string,
     *   primaryColor?: ?string,
     *   secondaryColor?: ?string,
     *   textColor?: ?string,
     *   title?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->active = $values['active'] ?? null;
        $this->cardId = $values['cardId'];
        $this->paperSize = $values['paperSize'] ?? null;
        $this->primaryColor = $values['primaryColor'] ?? null;
        $this->secondaryColor = $values['secondaryColor'] ?? null;
        $this->textColor = $values['textColor'] ?? null;
        $this->title = $values['title'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
