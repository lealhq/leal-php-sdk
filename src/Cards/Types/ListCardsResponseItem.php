<?php

namespace Leal\Cards\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;
use Leal\Core\Types\ArrayType;

class ListCardsResponseItem extends JsonSerializableType
{
    /**
     * @var string $applePassStyle Apple Wallet layout: 'store_card' (the classic layout) or 'poster' (iOS 27 full-bleed artwork; iPhones on iOS 26 or earlier show the store card)
     */
    #[JsonProperty('apple_pass_style')]
    public string $applePassStyle;

    /**
     * @var string $archivedAt ISO 8601 timestamp when the card was archived, or null if active
     */
    #[JsonProperty('archived_at')]
    public string $archivedAt;

    /**
     * @var array<string> $auxiliaryFields Up to two extra front-of-pass fields
     */
    #[JsonProperty('auxiliary_fields'), ArrayType(['string'])]
    public array $auxiliaryFields;

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
     * @var string $expiresAt ISO 8601 timestamp when the card expires, or null if it does not expire
     */
    #[JsonProperty('expires_at')]
    public string $expiresAt;

    /**
     * @var array<string> $featuredActions Up to two buttons: Featured Actions under the iOS 27 poster, and links under the pass in Google Wallet
     */
    #[JsonProperty('featured_actions'), ArrayType(['string'])]
    public array $featuredActions;

    /**
     * @var string $googleLogoStyle How the logo sits on Google Wallet: 'round' (the square icon in a circle, with the store name) or 'wide' (the logo in place of the circle and store name)
     */
    #[JsonProperty('google_logo_style')]
    public string $googleLogoStyle;

    /**
     * @var ListCardsResponseItemGoogleWallet $googleWallet
     */
    #[JsonProperty('google_wallet')]
    public ListCardsResponseItemGoogleWallet $googleWallet;

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
     * @var string $qrStyle What the wallet pass QR holds: 'link' (the customer's invite link with the card code after the #, readable by the Leal scanner and by `search`) or 'code' (the bare card code). Cards created before referrals use 'code'
     */
    #[JsonProperty('qr_style')]
    public string $qrStyle;

    /**
     * @var float $refereeStamps Stamps the invited friend gets when the referral pays out
     */
    #[JsonProperty('referee_stamps')]
    public float $refereeStamps;

    /**
     * @var bool $referralsEnabled Whether customers can invite friends from the back of their pass. A referral pays out when the store first stamps the friend's card for a visit (a scan, or the API/POS), never for signing up
     */
    #[JsonProperty('referrals_enabled')]
    public bool $referralsEnabled;

    /**
     * @var float $referrerStamps Stamps the inviting customer gets when the referral pays out
     */
    #[JsonProperty('referrer_stamps')]
    public float $referrerStamps;

    /**
     * @var int $rewardsCount Number of rewards defined for this card
     */
    #[JsonProperty('rewards_count')]
    public int $rewardsCount;

    /**
     * @var bool $showMemberField Whether wallet passes show the member name field
     */
    #[JsonProperty('show_member_field')]
    public bool $showMemberField;

    /**
     * @var bool $showStampsToRewardField Whether wallet passes show the stamps-to-reward field
     */
    #[JsonProperty('show_stamps_to_reward_field')]
    public bool $showStampsToRewardField;

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
     * @var float $stripOpacity Opacity (0–100) of the strip background over the card colour, for a colour, an uploaded image or a preset alike. 100 renders the colour or image exactly as supplied; lower values let the card colour show through
     */
    #[JsonProperty('strip_opacity')]
    public float $stripOpacity;

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
     *   applePassStyle: string,
     *   archivedAt: string,
     *   auxiliaryFields: array<string>,
     *   cardColor: string,
     *   createdAt: string,
     *   customerCardsCount: int,
     *   expiresAt: string,
     *   featuredActions: array<string>,
     *   googleLogoStyle: string,
     *   googleWallet: ListCardsResponseItemGoogleWallet,
     *   headerText: string,
     *   id: int,
     *   initialStamps: int,
     *   name: string,
     *   qrStyle: string,
     *   refereeStamps: float,
     *   referralsEnabled: bool,
     *   referrerStamps: float,
     *   rewardsCount: int,
     *   showMemberField: bool,
     *   showStampsToRewardField: bool,
     *   stampBackgroundColor: string,
     *   stampColor: string,
     *   stampIcon: string,
     *   stampsRequired: int,
     *   stripColor: string,
     *   stripOpacity: float,
     *   stripPreset: string,
     *   stripType: string,
     *   textColor: string,
     *   updatedAt: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->applePassStyle = $values['applePassStyle'];
        $this->archivedAt = $values['archivedAt'];
        $this->auxiliaryFields = $values['auxiliaryFields'];
        $this->cardColor = $values['cardColor'];
        $this->createdAt = $values['createdAt'];
        $this->customerCardsCount = $values['customerCardsCount'];
        $this->expiresAt = $values['expiresAt'];
        $this->featuredActions = $values['featuredActions'];
        $this->googleLogoStyle = $values['googleLogoStyle'];
        $this->googleWallet = $values['googleWallet'];
        $this->headerText = $values['headerText'];
        $this->id = $values['id'];
        $this->initialStamps = $values['initialStamps'];
        $this->name = $values['name'];
        $this->qrStyle = $values['qrStyle'];
        $this->refereeStamps = $values['refereeStamps'];
        $this->referralsEnabled = $values['referralsEnabled'];
        $this->referrerStamps = $values['referrerStamps'];
        $this->rewardsCount = $values['rewardsCount'];
        $this->showMemberField = $values['showMemberField'];
        $this->showStampsToRewardField = $values['showStampsToRewardField'];
        $this->stampBackgroundColor = $values['stampBackgroundColor'];
        $this->stampColor = $values['stampColor'];
        $this->stampIcon = $values['stampIcon'];
        $this->stampsRequired = $values['stampsRequired'];
        $this->stripColor = $values['stripColor'];
        $this->stripOpacity = $values['stripOpacity'];
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
