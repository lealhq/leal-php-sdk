<?php

namespace Leal\Locations\Requests;

use Leal\Core\Json\JsonSerializableType;
use Leal\Locations\Types\CreateLocationsRequestLocation;
use Leal\Core\Json\JsonProperty;

class CreateLocationsRequest extends JsonSerializableType
{
    /**
     * @var CreateLocationsRequestLocation $location
     */
    #[JsonProperty('location')]
    public CreateLocationsRequestLocation $location;

    /**
     * @param array{
     *   location: CreateLocationsRequestLocation,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->location = $values['location'];
    }
}
