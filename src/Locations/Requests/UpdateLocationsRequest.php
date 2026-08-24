<?php

namespace Leal\Locations\Requests;

use Leal\Core\Json\JsonSerializableType;
use Leal\Locations\Types\UpdateLocationsRequestLocation;
use Leal\Core\Json\JsonProperty;

class UpdateLocationsRequest extends JsonSerializableType
{
    /**
     * @var UpdateLocationsRequestLocation $location
     */
    #[JsonProperty('location')]
    public UpdateLocationsRequestLocation $location;

    /**
     * @param array{
     *   location: UpdateLocationsRequestLocation,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->location = $values['location'];
    }
}
