<?php

namespace Leal\Locations\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class UpdateLocationsRequestLocation extends JsonSerializableType
{
    /**
     * @var ?string $address Full street address – automatically geocoded to lat/lng
     */
    #[JsonProperty('address')]
    public ?string $address;

    /**
     * @var ?string $name Location name
     */
    #[JsonProperty('name')]
    public ?string $name;

    /**
     * @param array{
     *   address?: ?string,
     *   name?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->address = $values['address'] ?? null;
        $this->name = $values['name'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
