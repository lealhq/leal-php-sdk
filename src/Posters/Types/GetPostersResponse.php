<?php

namespace Leal\Posters\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class GetPostersResponse extends JsonSerializableType
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
     *   createdAt: string,
     *   displayUrl: string,
     *   id: int,
     *   paperSize: string,
     *   primaryColor: string,
     *   qrCodeUrl: string,
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
        $this->createdAt = $values['createdAt'];
        $this->displayUrl = $values['displayUrl'];
        $this->id = $values['id'];
        $this->paperSize = $values['paperSize'];
        $this->primaryColor = $values['primaryColor'];
        $this->qrCodeUrl = $values['qrCodeUrl'];
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
