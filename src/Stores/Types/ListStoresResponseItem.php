<?php

namespace Leal\Stores\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class ListStoresResponseItem extends JsonSerializableType
{
    /**
     * @var int $cardsCount Number of loyalty card templates
     */
    #[JsonProperty('cards_count')]
    public int $cardsCount;

    /**
     * @var string $createdAt ISO 8601 creation timestamp
     */
    #[JsonProperty('created_at')]
    public string $createdAt;

    /**
     * @var int $customersCount Number of enrolled customers
     */
    #[JsonProperty('customers_count')]
    public int $customersCount;

    /**
     * @var string $displayStoreName Resolved display name (store_name if present, otherwise name)
     */
    #[JsonProperty('display_store_name')]
    public string $displayStoreName;

    /**
     * @var int $id Unique store ID
     */
    #[JsonProperty('id')]
    public int $id;

    /**
     * @var int $locationsCount Number of physical locations
     */
    #[JsonProperty('locations_count')]
    public int $locationsCount;

    /**
     * @var string $name Internal account name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var bool $personal Whether this is the user's personal account
     */
    #[JsonProperty('personal')]
    public bool $personal;

    /**
     * @var int $postersCount Number of QR signup posters
     */
    #[JsonProperty('posters_count')]
    public int $postersCount;

    /**
     * @var string $storeName Public-facing store name
     */
    #[JsonProperty('store_name')]
    public string $storeName;

    /**
     * @var string $updatedAt ISO 8601 last-update timestamp
     */
    #[JsonProperty('updated_at')]
    public string $updatedAt;

    /**
     * @param array{
     *   cardsCount: int,
     *   createdAt: string,
     *   customersCount: int,
     *   displayStoreName: string,
     *   id: int,
     *   locationsCount: int,
     *   name: string,
     *   personal: bool,
     *   postersCount: int,
     *   storeName: string,
     *   updatedAt: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->cardsCount = $values['cardsCount'];
        $this->createdAt = $values['createdAt'];
        $this->customersCount = $values['customersCount'];
        $this->displayStoreName = $values['displayStoreName'];
        $this->id = $values['id'];
        $this->locationsCount = $values['locationsCount'];
        $this->name = $values['name'];
        $this->personal = $values['personal'];
        $this->postersCount = $values['postersCount'];
        $this->storeName = $values['storeName'];
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
