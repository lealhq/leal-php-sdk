<?php

namespace Leal\WebhookSubscriptions\Requests;

use Leal\Core\Json\JsonSerializableType;

class GetApiV1AccountsAccountIdWebhookSubscriptionsRequest extends JsonSerializableType
{
    /**
     * @var ?string $event Only return subscriptions that list this event (or `*`)
     */
    public ?string $event;

    /**
     * @param array{
     *   event?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->event = $values['event'] ?? null;
    }
}
