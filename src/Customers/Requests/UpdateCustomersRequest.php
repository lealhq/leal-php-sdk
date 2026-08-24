<?php

namespace Leal\Customers\Requests;

use Leal\Core\Json\JsonSerializableType;
use Leal\Customers\Types\UpdateCustomersRequestCustomer;
use Leal\Core\Json\JsonProperty;

class UpdateCustomersRequest extends JsonSerializableType
{
    /**
     * @var UpdateCustomersRequestCustomer $customer
     */
    #[JsonProperty('customer')]
    public UpdateCustomersRequestCustomer $customer;

    /**
     * @param array{
     *   customer: UpdateCustomersRequestCustomer,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->customer = $values['customer'];
    }
}
