<?php

namespace Leal\CustomerCards\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class RedeemCustomerCardsResponse extends JsonSerializableType
{
    /**
     * @var RedeemCustomerCardsResponseRedemption $redemption
     */
    #[JsonProperty('redemption')]
    public RedeemCustomerCardsResponseRedemption $redemption;

    /**
     * @var bool $success True when the reward was redeemed
     */
    #[JsonProperty('success')]
    public bool $success;

    /**
     * @param array{
     *   redemption: RedeemCustomerCardsResponseRedemption,
     *   success: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->redemption = $values['redemption'];
        $this->success = $values['success'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
