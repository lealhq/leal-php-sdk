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
     * @var ?string $contactCollectionMode Which contact fields appear on the public signup form
     */
    #[JsonProperty('contact_collection_mode')]
    public ?string $contactCollectionMode;

    /**
     * @var ?float $minimumAge Minimum customer age required for signup. Requires require_birthday to be true.
     */
    #[JsonProperty('minimum_age')]
    public ?float $minimumAge;

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
     * @var ?bool $requireBirthday Whether date of birth is required on the public signup form
     */
    #[JsonProperty('require_birthday')]
    public ?bool $requireBirthday;

    /**
     * @var ?bool $requireEmail Whether email is required when it is collected
     */
    #[JsonProperty('require_email')]
    public ?bool $requireEmail;

    /**
     * @var ?bool $requirePhone Whether phone number is required when it is collected
     */
    #[JsonProperty('require_phone')]
    public ?bool $requirePhone;

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
     *   contactCollectionMode?: ?string,
     *   minimumAge?: ?float,
     *   paperSize?: ?string,
     *   primaryColor?: ?string,
     *   requireBirthday?: ?bool,
     *   requireEmail?: ?bool,
     *   requirePhone?: ?bool,
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
        $this->contactCollectionMode = $values['contactCollectionMode'] ?? null;
        $this->minimumAge = $values['minimumAge'] ?? null;
        $this->paperSize = $values['paperSize'] ?? null;
        $this->primaryColor = $values['primaryColor'] ?? null;
        $this->requireBirthday = $values['requireBirthday'] ?? null;
        $this->requireEmail = $values['requireEmail'] ?? null;
        $this->requirePhone = $values['requirePhone'] ?? null;
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
