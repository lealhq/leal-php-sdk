<?php

namespace Leal\Cards\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;
use Leal\Core\Types\ArrayType;

class UpdateCardsResponseGoogleWallet extends JsonSerializableType
{
    /**
     * @var string $heroImage What fills the hero image behind the stamps: 'hero_image' (uploaded in Leal), 'strip_image', 'preset' or 'color'
     */
    #[JsonProperty('hero_image')]
    public string $heroImage;

    /**
     * @var string $textColor The text colour Google Wallet uses on this card: it picks black or white itself and ignores text_color
     */
    #[JsonProperty('text_color')]
    public string $textColor;

    /**
     * @var array<string> $warnings Guidelines the card doesn't meet: any of 'color', 'title', 'issuer_name', 'field_labels', 'field_values', 'logo', 'hero'. Empty when it meets them all
     */
    #[JsonProperty('warnings'), ArrayType(['string'])]
    public array $warnings;

    /**
     * @param array{
     *   heroImage: string,
     *   textColor: string,
     *   warnings: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->heroImage = $values['heroImage'];
        $this->textColor = $values['textColor'];
        $this->warnings = $values['warnings'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
