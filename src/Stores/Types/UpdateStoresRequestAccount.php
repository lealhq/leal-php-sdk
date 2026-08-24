<?php

namespace Leal\Stores\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class UpdateStoresRequestAccount extends JsonSerializableType
{
    /**
     * @var ?string $name Internal account name
     */
    #[JsonProperty('name')]
    public ?string $name;

    /**
     * @var ?string $storeName Public-facing store name shown to customers
     */
    #[JsonProperty('store_name')]
    public ?string $storeName;

    /**
     * @param array{
     *   name?: ?string,
     *   storeName?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->storeName = $values['storeName'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
