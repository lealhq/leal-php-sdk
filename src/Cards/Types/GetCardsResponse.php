<?php

namespace Leal\Cards\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class GetCardsResponse extends JsonSerializableType
{
    /**
     * @var string $archivedAt ISO 8601 timestamp when the card was archived, or null if active
     */
    #[JsonProperty('archived_at')]
    public string $archivedAt;

    /**
     * @var string $cardColor Hex colour for the card background (e.g. '#6B4226')
     */
    #[JsonProperty('card_color')]
    public string $cardColor;

    /**
     * @var string $createdAt ISO 8601 creation timestamp
     */
    #[JsonProperty('created_at')]
    public string $createdAt;

    /**
     * @var int $customerCardsCount Number of customer card instances issued
     */
    #[JsonProperty('customer_cards_count')]
    public int $customerCardsCount;

    /**
     * @var string $headerText Optional header text displayed on the card
     */
    #[JsonProperty('header_text')]
    public string $headerText;

    /**
     * @var int $id Unique card ID
     */
    #[JsonProperty('id')]
    public int $id;

    /**
     * @var int $initialStamps Number of stamps pre-filled on new customer cards (0 to stamps_required - 1)
     */
    #[JsonProperty('initial_stamps')]
    public int $initialStamps;

    /**
     * @var string $name Card name (e.g. 'Coffee Loyalty Card')
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var int $rewardsCount Number of rewards defined for this card
     */
    #[JsonProperty('rewards_count')]
    public int $rewardsCount;

    /**
     * @var string $stampBackgroundColor Hex colour for stamp backgrounds
     */
    #[JsonProperty('stamp_background_color')]
    public string $stampBackgroundColor;

    /**
     * @var string $stampColor Hex colour for stamp icons
     */
    #[JsonProperty('stamp_color')]
    public string $stampColor;

    /**
     * @var string $stampIcon Icon used for stamps (e.g. 'coffee', 'heart', 'star')
     */
    #[JsonProperty('stamp_icon')]
    public string $stampIcon;

    /**
     * @var int $stampsRequired Number of stamps needed to complete the card (1–21)
     */
    #[JsonProperty('stamps_required')]
    public int $stampsRequired;

    /**
     * @var string $stripColor Hex colour for the strip (when strip_type is 'color')
     */
    #[JsonProperty('strip_color')]
    public string $stripColor;

    /**
     * @var string $stripPreset Preset strip image identifier (when strip_type is 'preset')
     */
    #[JsonProperty('strip_preset')]
    public string $stripPreset;

    /**
     * @var string $stripType Strip image type: 'color', 'image', or 'preset'
     */
    #[JsonProperty('strip_type')]
    public string $stripType;

    /**
     * @var string $textColor Hex colour for card text
     */
    #[JsonProperty('text_color')]
    public string $textColor;

    /**
     * @var string $updatedAt ISO 8601 last-update timestamp
     */
    #[JsonProperty('updated_at')]
    public string $updatedAt;

    /**
     * @param array{
     *   archivedAt: string,
     *   cardColor: string,
     *   createdAt: string,
     *   customerCardsCount: int,
     *   headerText: string,
     *   id: int,
     *   initialStamps: int,
     *   name: string,
     *   rewardsCount: int,
     *   stampBackgroundColor: string,
     *   stampColor: string,
     *   stampIcon: string,
     *   stampsRequired: int,
     *   stripColor: string,
     *   stripPreset: string,
     *   stripType: string,
     *   textColor: string,
     *   updatedAt: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->archivedAt = $values['archivedAt'];
        $this->cardColor = $values['cardColor'];
        $this->createdAt = $values['createdAt'];
        $this->customerCardsCount = $values['customerCardsCount'];
        $this->headerText = $values['headerText'];
        $this->id = $values['id'];
        $this->initialStamps = $values['initialStamps'];
        $this->name = $values['name'];
        $this->rewardsCount = $values['rewardsCount'];
        $this->stampBackgroundColor = $values['stampBackgroundColor'];
        $this->stampColor = $values['stampColor'];
        $this->stampIcon = $values['stampIcon'];
        $this->stampsRequired = $values['stampsRequired'];
        $this->stripColor = $values['stripColor'];
        $this->stripPreset = $values['stripPreset'];
        $this->stripType = $values['stripType'];
        $this->textColor = $values['textColor'];
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
