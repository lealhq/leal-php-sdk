<?php

namespace Leal\Locations\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class CreateLocationsRequestLocation extends JsonSerializableType
{
    /**
     * @var string $address Full street address – automatically geocoded to lat/lng
     */
    #[JsonProperty('address')]
    public string $address;

    /**
     * @var string $name Location name (e.g. 'High Street Branch')
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @param array{
     *   address: string,
     *   name: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->address = $values['address'];
        $this->name = $values['name'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
