<?php

namespace Leal\Posters\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class ListPostersResponseItem extends JsonSerializableType
{
    /**
     * @var int $accountId Parent store ID
     */
    #[JsonProperty('account_id')]
    public int $accountId;

    /**
     * @var bool $active Whether the public signup URL is live
     */
    #[JsonProperty('active')]
    public bool $active;

    /**
     * @var int $cardId Loyalty card customers are signed up to
     */
    #[JsonProperty('card_id')]
    public int $cardId;

    /**
     * @var bool $collectEmail Whether the public signup form collects email
     */
    #[JsonProperty('collect_email')]
    public bool $collectEmail;

    /**
     * @var bool $collectPhone Whether the public signup form collects phone number
     */
    #[JsonProperty('collect_phone')]
    public bool $collectPhone;

    /**
     * @var string $contactCollectionMode Which contact fields appear on the public signup form: 'email_and_phone', 'email_only', or 'phone_only'
     */
    #[JsonProperty('contact_collection_mode')]
    public string $contactCollectionMode;

    /**
     * @var string $createdAt ISO 8601 creation timestamp
     */
    #[JsonProperty('created_at')]
    public string $createdAt;

    /**
     * @var string $displayUrl URL of the on screen version of the poster
     */
    #[JsonProperty('display_url')]
    public string $displayUrl;

    /**
     * @var int $id Unique poster ID
     */
    #[JsonProperty('id')]
    public int $id;

    /**
     * @var float $minimumAge Minimum customer age required for signup
     */
    #[JsonProperty('minimum_age')]
    public float $minimumAge;

    /**
     * @var string $paperSize Paper size the poster is laid out for
     */
    #[JsonProperty('paper_size')]
    public string $paperSize;

    /**
     * @var string $primaryColor Hex colour for the poster background
     */
    #[JsonProperty('primary_color')]
    public string $primaryColor;

    /**
     * @var string $qrCodeUrl URL encoded in the QR code
     */
    #[JsonProperty('qr_code_url')]
    public string $qrCodeUrl;

    /**
     * @var bool $requireBirthday Whether date of birth is required on the public signup form
     */
    #[JsonProperty('require_birthday')]
    public bool $requireBirthday;

    /**
     * @var bool $requireEmail Whether email is required when it is collected
     */
    #[JsonProperty('require_email')]
    public bool $requireEmail;

    /**
     * @var bool $requirePhone Whether phone number is required when it is collected
     */
    #[JsonProperty('require_phone')]
    public bool $requirePhone;

    /**
     * @var string $secondaryColor Hex accent colour
     */
    #[JsonProperty('secondary_color')]
    public string $secondaryColor;

    /**
     * @var string $signupUrl Public URL the QR code points at
     */
    #[JsonProperty('signup_url')]
    public string $signupUrl;

    /**
     * @var string $textColor Hex colour for poster text
     */
    #[JsonProperty('text_color')]
    public string $textColor;

    /**
     * @var string $title Heading printed on the poster
     */
    #[JsonProperty('title')]
    public string $title;

    /**
     * @var string $updatedAt ISO 8601 last-update timestamp
     */
    #[JsonProperty('updated_at')]
    public string $updatedAt;

    /**
     * @param array{
     *   accountId: int,
     *   active: bool,
     *   cardId: int,
     *   collectEmail: bool,
     *   collectPhone: bool,
     *   contactCollectionMode: string,
     *   createdAt: string,
     *   displayUrl: string,
     *   id: int,
     *   minimumAge: float,
     *   paperSize: string,
     *   primaryColor: string,
     *   qrCodeUrl: string,
     *   requireBirthday: bool,
     *   requireEmail: bool,
     *   requirePhone: bool,
     *   secondaryColor: string,
     *   signupUrl: string,
     *   textColor: string,
     *   title: string,
     *   updatedAt: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->accountId = $values['accountId'];
        $this->active = $values['active'];
        $this->cardId = $values['cardId'];
        $this->collectEmail = $values['collectEmail'];
        $this->collectPhone = $values['collectPhone'];
        $this->contactCollectionMode = $values['contactCollectionMode'];
        $this->createdAt = $values['createdAt'];
        $this->displayUrl = $values['displayUrl'];
        $this->id = $values['id'];
        $this->minimumAge = $values['minimumAge'];
        $this->paperSize = $values['paperSize'];
        $this->primaryColor = $values['primaryColor'];
        $this->qrCodeUrl = $values['qrCodeUrl'];
        $this->requireBirthday = $values['requireBirthday'];
        $this->requireEmail = $values['requireEmail'];
        $this->requirePhone = $values['requirePhone'];
        $this->secondaryColor = $values['secondaryColor'];
        $this->signupUrl = $values['signupUrl'];
        $this->textColor = $values['textColor'];
        $this->title = $values['title'];
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
