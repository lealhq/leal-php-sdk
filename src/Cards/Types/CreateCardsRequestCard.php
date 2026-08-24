<?php

namespace Leal\Cards\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class CreateCardsRequestCard extends JsonSerializableType
{
    /**
     * @var ?string $cardColor Hex colour for the card background (e.g. '#6B4226')
     */
    #[JsonProperty('card_color')]
    public ?string $cardColor;

    /**
     * @var ?string $headerText Optional header text displayed on the card
     */
    #[JsonProperty('header_text')]
    public ?string $headerText;

    /**
     * @var ?int $initialStamps Number of stamps pre-filled on new customer cards (must be >= 0 and < stamps_required)
     */
    #[JsonProperty('initial_stamps')]
    public ?int $initialStamps;

    /**
     * @var string $name Card name (e.g. 'Coffee Loyalty Card')
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var ?string $stampBackgroundColor Hex colour for stamp backgrounds
     */
    #[JsonProperty('stamp_background_color')]
    public ?string $stampBackgroundColor;

    /**
     * @var ?string $stampColor Hex colour for stamp icons
     */
    #[JsonProperty('stamp_color')]
    public ?string $stampColor;

    /**
     * @var ?string $stampIcon Stamp icon identifier
     */
    #[JsonProperty('stamp_icon')]
    public ?string $stampIcon;

    /**
     * @var ?int $stampsRequired Number of stamps needed to complete the card (1–21)
     */
    #[JsonProperty('stamps_required')]
    public ?int $stampsRequired;

    /**
     * @var ?string $stripColor Hex colour for the strip (used when strip_type is 'color')
     */
    #[JsonProperty('strip_color')]
    public ?string $stripColor;

    /**
     * @var ?string $stripPreset Preset strip image identifier (used when strip_type is 'preset')
     */
    #[JsonProperty('strip_preset')]
    public ?string $stripPreset;

    /**
     * @var ?string $stripType Strip image type
     */
    #[JsonProperty('strip_type')]
    public ?string $stripType;

    /**
     * @var ?string $textColor Hex colour for card text
     */
    #[JsonProperty('text_color')]
    public ?string $textColor;

    /**
     * @param array{
     *   name: string,
     *   cardColor?: ?string,
     *   headerText?: ?string,
     *   initialStamps?: ?int,
     *   stampBackgroundColor?: ?string,
     *   stampColor?: ?string,
     *   stampIcon?: ?string,
     *   stampsRequired?: ?int,
     *   stripColor?: ?string,
     *   stripPreset?: ?string,
     *   stripType?: ?string,
     *   textColor?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->cardColor = $values['cardColor'] ?? null;
        $this->headerText = $values['headerText'] ?? null;
        $this->initialStamps = $values['initialStamps'] ?? null;
        $this->name = $values['name'];
        $this->stampBackgroundColor = $values['stampBackgroundColor'] ?? null;
        $this->stampColor = $values['stampColor'] ?? null;
        $this->stampIcon = $values['stampIcon'] ?? null;
        $this->stampsRequired = $values['stampsRequired'] ?? null;
        $this->stripColor = $values['stripColor'] ?? null;
        $this->stripPreset = $values['stripPreset'] ?? null;
        $this->stripType = $values['stripType'] ?? null;
        $this->textColor = $values['textColor'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
