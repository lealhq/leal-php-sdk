<?php

namespace Leal\Cards\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;
use Leal\Core\Types\ArrayType;

class UpdateCardsRequestCard extends JsonSerializableType
{
    /**
     * @var ?array<string> $auxiliaryFields Up to two extra front-of-pass fields. Blank values are ignored.
     */
    #[JsonProperty('auxiliary_fields'), ArrayType(['string'])]
    public ?array $auxiliaryFields;

    /**
     * @var ?string $cardColor Hex colour for the card background
     */
    #[JsonProperty('card_color')]
    public ?string $cardColor;

    /**
     * @var ?string $expiresAt Card expiry timestamp (ISO 8601)
     */
    #[JsonProperty('expires_at')]
    public ?string $expiresAt;

    /**
     * @var ?string $headerText Optional header text displayed on the card
     */
    #[JsonProperty('header_text')]
    public ?string $headerText;

    /**
     * @var ?int $initialStamps Pre-filled stamps (must be >= 0 and < stamps_required)
     */
    #[JsonProperty('initial_stamps')]
    public ?int $initialStamps;

    /**
     * @var ?string $name Card name
     */
    #[JsonProperty('name')]
    public ?string $name;

    /**
     * @var ?bool $showMemberField Whether wallet passes show the member name field
     */
    #[JsonProperty('show_member_field')]
    public ?bool $showMemberField;

    /**
     * @var ?bool $showStampsToRewardField Whether wallet passes show the stamps-to-reward field
     */
    #[JsonProperty('show_stamps_to_reward_field')]
    public ?bool $showStampsToRewardField;

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
     * @var ?int $stampsRequired Number of stamps needed (1–21)
     */
    #[JsonProperty('stamps_required')]
    public ?int $stampsRequired;

    /**
     * @var ?string $stripColor Hex colour for the strip
     */
    #[JsonProperty('strip_color')]
    public ?string $stripColor;

    /**
     * @var ?string $stripPreset Preset strip image identifier
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
     *   auxiliaryFields?: ?array<string>,
     *   cardColor?: ?string,
     *   expiresAt?: ?string,
     *   headerText?: ?string,
     *   initialStamps?: ?int,
     *   name?: ?string,
     *   showMemberField?: ?bool,
     *   showStampsToRewardField?: ?bool,
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
        array $values = [],
    ) {
        $this->auxiliaryFields = $values['auxiliaryFields'] ?? null;
        $this->cardColor = $values['cardColor'] ?? null;
        $this->expiresAt = $values['expiresAt'] ?? null;
        $this->headerText = $values['headerText'] ?? null;
        $this->initialStamps = $values['initialStamps'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->showMemberField = $values['showMemberField'] ?? null;
        $this->showStampsToRewardField = $values['showStampsToRewardField'] ?? null;
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
