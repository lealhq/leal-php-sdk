<?php

namespace Leal\Customers\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;
use Leal\Core\Types\ArrayType;

class UpdateCustomersRequestCustomer extends JsonSerializableType
{
    /**
     * @var ?string $birthday Customer's birthday (YYYY-MM-DD)
     */
    #[JsonProperty('birthday')]
    public ?string $birthday;

    /**
     * @var ?string $email Customer's email address (unique per store)
     */
    #[JsonProperty('email')]
    public ?string $email;

    /**
     * @var ?array<string> $externalReferences Array of `{source, external_id, metadata}` objects to upsert
     */
    #[JsonProperty('external_references'), ArrayType(['string'])]
    public ?array $externalReferences;

    /**
     * @var ?string $firstName Customer's first name
     */
    #[JsonProperty('first_name')]
    public ?string $firstName;

    /**
     * @var ?string $lastName Customer's last name
     */
    #[JsonProperty('last_name')]
    public ?string $lastName;

    /**
     * @var ?array<string, mixed> $metadata Shallow-merged into existing metadata
     */
    #[JsonProperty('metadata'), ArrayType(['string' => 'mixed'])]
    public ?array $metadata;

    /**
     * @var ?string $phone Customer's phone number (unique per store)
     */
    #[JsonProperty('phone')]
    public ?string $phone;

    /**
     * @param array{
     *   birthday?: ?string,
     *   email?: ?string,
     *   externalReferences?: ?array<string>,
     *   firstName?: ?string,
     *   lastName?: ?string,
     *   metadata?: ?array<string, mixed>,
     *   phone?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->birthday = $values['birthday'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->externalReferences = $values['externalReferences'] ?? null;
        $this->firstName = $values['firstName'] ?? null;
        $this->lastName = $values['lastName'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->phone = $values['phone'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
