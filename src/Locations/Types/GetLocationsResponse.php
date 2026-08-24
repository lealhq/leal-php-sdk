<?php

namespace Leal\Locations\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class GetLocationsResponse extends JsonSerializableType
{
    /**
     * @var int $accountId Parent store ID
     */
    #[JsonProperty('account_id')]
    public int $accountId;

    /**
     * @var string $address Full street address
     */
    #[JsonProperty('address')]
    public string $address;

    /**
     * @var string $createdAt ISO 8601 creation timestamp
     */
    #[JsonProperty('created_at')]
    public string $createdAt;

    /**
     * @var int $id Unique location ID
     */
    #[JsonProperty('id')]
    public int $id;

    /**
     * @var float $latitude Geocoded latitude (auto-derived from address)
     */
    #[JsonProperty('latitude')]
    public float $latitude;

    /**
     * @var float $longitude Geocoded longitude (auto-derived from address)
     */
    #[JsonProperty('longitude')]
    public float $longitude;

    /**
     * @var string $name Location name (e.g. 'Downtown Branch')
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var string $updatedAt ISO 8601 last-update timestamp
     */
    #[JsonProperty('updated_at')]
    public string $updatedAt;

    /**
     * @param array{
     *   accountId: int,
     *   address: string,
     *   createdAt: string,
     *   id: int,
     *   latitude: float,
     *   longitude: float,
     *   name: string,
     *   updatedAt: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->accountId = $values['accountId'];
        $this->address = $values['address'];
        $this->createdAt = $values['createdAt'];
        $this->id = $values['id'];
        $this->latitude = $values['latitude'];
        $this->longitude = $values['longitude'];
        $this->name = $values['name'];
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
