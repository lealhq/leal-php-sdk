<?php

namespace Leal\Stores\Requests;

use Leal\Core\Json\JsonSerializableType;
use Leal\Stores\Types\UpdateStoresRequestAccount;
use Leal\Core\Json\JsonProperty;

class UpdateStoresRequest extends JsonSerializableType
{
    /**
     * @var UpdateStoresRequestAccount $account
     */
    #[JsonProperty('account')]
    public UpdateStoresRequestAccount $account;

    /**
     * @param array{
     *   account: UpdateStoresRequestAccount,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->account = $values['account'];
    }
}
