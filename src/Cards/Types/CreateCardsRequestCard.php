<?php

namespace Leal\Cards\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;
use Leal\Core\Types\ArrayType;

class CreateCardsRequestCard extends JsonSerializableType
{
    /**
     * @var ?value-of<CreateCardsRequestCardApplePassStyle> $applePassStyle Apple Wallet layout. 'poster' is iOS 27's full-bleed layout; older iPhones show the store card. Defaults to 'store_card'
     */
    #[JsonProperty('apple_pass_style')]
    public ?string $applePassStyle;

    /**
     * @var ?array<string> $auxiliaryFields Up to two extra front-of-pass fields. Blank values are ignored.
     */
    #[JsonProperty('auxiliary_fields'), ArrayType(['string'])]
    public ?array $auxiliaryFields;

    /**
     * @var ?string $cardColor Hex colour for the card background (e.g. '#6B4226')
     */
    #[JsonProperty('card_color')]
    public ?string $cardColor;

    /**
     * @var ?string $expiresAt Card expiry timestamp (ISO 8601)
     */
    #[JsonProperty('expires_at')]
    public ?string $expiresAt;

    /**
     * @var ?array<string> $featuredActions Up to two buttons, shown as Featured Actions under the iOS 27 poster and as links in Google Wallet. Send an empty array to remove them.
     */
    #[JsonProperty('featured_actions'), ArrayType(['string'])]
    public ?array $featuredActions;

    /**
     * @var ?value-of<CreateCardsRequestCardGoogleLogoStyle> $googleLogoStyle How the logo sits on Google Wallet. Defaults to 'round'
     */
    #[JsonProperty('google_logo_style')]
    public ?string $googleLogoStyle;

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
     * @var ?value-of<CreateCardsRequestCardQrStyle> $qrStyle What the wallet pass QR holds. Defaults to 'link' for new cards
     */
    #[JsonProperty('qr_style')]
    public ?string $qrStyle;

    /**
     * @var ?float $refereeStamps Stamps the invited friend gets on their first stamped visit (>= 0 and < stamps_required, default 1)
     */
    #[JsonProperty('referee_stamps')]
    public ?float $refereeStamps;

    /**
     * @var ?bool $referralsEnabled Let customers invite friends from the back of their pass (default false)
     */
    #[JsonProperty('referrals_enabled')]
    public ?bool $referralsEnabled;

    /**
     * @var ?float $referrerStamps Stamps the inviting customer gets when the friend's first visit is stamped (>= 0 and < stamps_required, default 1)
     */
    #[JsonProperty('referrer_stamps')]
    public ?float $referrerStamps;

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
     * @var ?float $stripOpacity Opacity (0–100) of the strip background over the card colour. Defaults to 100, which renders the colour or image exactly as supplied
     */
    #[JsonProperty('strip_opacity')]
    public ?float $stripOpacity;

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
     *   applePassStyle?: ?value-of<CreateCardsRequestCardApplePassStyle>,
     *   auxiliaryFields?: ?array<string>,
     *   cardColor?: ?string,
     *   expiresAt?: ?string,
     *   featuredActions?: ?array<string>,
     *   googleLogoStyle?: ?value-of<CreateCardsRequestCardGoogleLogoStyle>,
     *   headerText?: ?string,
     *   initialStamps?: ?int,
     *   qrStyle?: ?value-of<CreateCardsRequestCardQrStyle>,
     *   refereeStamps?: ?float,
     *   referralsEnabled?: ?bool,
     *   referrerStamps?: ?float,
     *   showMemberField?: ?bool,
     *   showStampsToRewardField?: ?bool,
     *   stampBackgroundColor?: ?string,
     *   stampColor?: ?string,
     *   stampIcon?: ?string,
     *   stampsRequired?: ?int,
     *   stripColor?: ?string,
     *   stripOpacity?: ?float,
     *   stripPreset?: ?string,
     *   stripType?: ?string,
     *   textColor?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->applePassStyle = $values['applePassStyle'] ?? null;
        $this->auxiliaryFields = $values['auxiliaryFields'] ?? null;
        $this->cardColor = $values['cardColor'] ?? null;
        $this->expiresAt = $values['expiresAt'] ?? null;
        $this->featuredActions = $values['featuredActions'] ?? null;
        $this->googleLogoStyle = $values['googleLogoStyle'] ?? null;
        $this->headerText = $values['headerText'] ?? null;
        $this->initialStamps = $values['initialStamps'] ?? null;
        $this->name = $values['name'];
        $this->qrStyle = $values['qrStyle'] ?? null;
        $this->refereeStamps = $values['refereeStamps'] ?? null;
        $this->referralsEnabled = $values['referralsEnabled'] ?? null;
        $this->referrerStamps = $values['referrerStamps'] ?? null;
        $this->showMemberField = $values['showMemberField'] ?? null;
        $this->showStampsToRewardField = $values['showStampsToRewardField'] ?? null;
        $this->stampBackgroundColor = $values['stampBackgroundColor'] ?? null;
        $this->stampColor = $values['stampColor'] ?? null;
        $this->stampIcon = $values['stampIcon'] ?? null;
        $this->stampsRequired = $values['stampsRequired'] ?? null;
        $this->stripColor = $values['stripColor'] ?? null;
        $this->stripOpacity = $values['stripOpacity'] ?? null;
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
