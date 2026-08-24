<?php

namespace Leal\Customers\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;
use Leal\Core\Types\ArrayType;

class UpdateCustomersResponse extends JsonSerializableType
{
    /**
     * @var int $accountId Parent store ID
     */
    #[JsonProperty('account_id')]
    public int $accountId;

    /**
     * @var string $birthday Birthday as YYYY-MM-DD
     */
    #[JsonProperty('birthday')]
    public string $birthday;

    /**
     * @var string $createdAt ISO 8601 creation timestamp
     */
    #[JsonProperty('created_at')]
    public string $createdAt;

    /**
     * @var array<string> $customerCards Cards this customer is enrolled on
     */
    #[JsonProperty('customer_cards'), ArrayType(['string'])]
    public array $customerCards;

    /**
     * @var string $email Email address, unique per store
     */
    #[JsonProperty('email')]
    public string $email;

    /**
     * @var array<string> $externalReferences Links to records in other systems
     */
    #[JsonProperty('external_references'), ArrayType(['string'])]
    public array $externalReferences;

    /**
     * @var string $firstName First name
     */
    #[JsonProperty('first_name')]
    public string $firstName;

    /**
     * @var int $id Unique customer ID
     */
    #[JsonProperty('id')]
    public int $id;

    /**
     * @var string $lastName Last name
     */
    #[JsonProperty('last_name')]
    public string $lastName;

    /**
     * @var array<string, mixed> $metadata Free form per customer data
     */
    #[JsonProperty('metadata'), ArrayType(['string' => 'mixed'])]
    public array $metadata;

    /**
     * @var string $phone Phone number, unique per store
     */
    #[JsonProperty('phone')]
    public string $phone;

    /**
     * @var int $stampCount Total stamps across every card
     */
    #[JsonProperty('stamp_count')]
    public int $stampCount;

    /**
     * @var string $updatedAt ISO 8601 last-update timestamp
     */
    #[JsonProperty('updated_at')]
    public string $updatedAt;

    /**
     * @param array{
     *   accountId: int,
     *   birthday: string,
     *   createdAt: string,
     *   customerCards: array<string>,
     *   email: string,
     *   externalReferences: array<string>,
     *   firstName: string,
     *   id: int,
     *   lastName: string,
     *   metadata: array<string, mixed>,
     *   phone: string,
     *   stampCount: int,
     *   updatedAt: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->accountId = $values['accountId'];
        $this->birthday = $values['birthday'];
        $this->createdAt = $values['createdAt'];
        $this->customerCards = $values['customerCards'];
        $this->email = $values['email'];
        $this->externalReferences = $values['externalReferences'];
        $this->firstName = $values['firstName'];
        $this->id = $values['id'];
        $this->lastName = $values['lastName'];
        $this->metadata = $values['metadata'];
        $this->phone = $values['phone'];
        $this->stampCount = $values['stampCount'];
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
