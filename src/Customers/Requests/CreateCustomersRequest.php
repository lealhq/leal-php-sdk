<?php

namespace Leal\Customers\Requests;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;
use Leal\Customers\Types\CreateCustomersRequestCustomer;

class CreateCustomersRequest extends JsonSerializableType
{
    /**
     * @var ?int $cardId Loyalty card ID to auto-enroll the customer in
     */
    #[JsonProperty('card_id')]
    public ?int $cardId;

    /**
     * @var CreateCustomersRequestCustomer $customer
     */
    #[JsonProperty('customer')]
    public CreateCustomersRequestCustomer $customer;

    /**
     * @var ?string $referralCode Records the new customer as invited by another customer: the code is the last part of that customer's `referral_url`. Needs `card_id`, for the same card, with referrals on. Nothing is given now; both customers get their stamps when the new customer's card is first stamped for a visit
     */
    #[JsonProperty('referral_code')]
    public ?string $referralCode;

    /**
     * @var ?bool $sendCardLinks When true, sends the card links to the customer via email/SMS after enrollment. Note: even without this flag, the response includes `apple_wallet_url` and `google_wallet_url` in each customer card object so you can deliver them yourself.
     */
    #[JsonProperty('send_card_links')]
    public ?bool $sendCardLinks;

    /**
     * @param array{
     *   customer: CreateCustomersRequestCustomer,
     *   cardId?: ?int,
     *   referralCode?: ?string,
     *   sendCardLinks?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->cardId = $values['cardId'] ?? null;
        $this->customer = $values['customer'];
        $this->referralCode = $values['referralCode'] ?? null;
        $this->sendCardLinks = $values['sendCardLinks'] ?? null;
    }
}
