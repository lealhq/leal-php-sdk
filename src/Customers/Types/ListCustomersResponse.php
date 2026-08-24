<?php

namespace Leal\Customers\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;
use Leal\Core\Types\ArrayType;

class ListCustomersResponse extends JsonSerializableType
{
    /**
     * @var array<string> $customers The customers on this page
     */
    #[JsonProperty('customers'), ArrayType(['string'])]
    public array $customers;

    /**
     * @var ListCustomersResponsePagination $pagination
     */
    #[JsonProperty('pagination')]
    public ListCustomersResponsePagination $pagination;

    /**
     * @param array{
     *   customers: array<string>,
     *   pagination: ListCustomersResponsePagination,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->customers = $values['customers'];
        $this->pagination = $values['pagination'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
