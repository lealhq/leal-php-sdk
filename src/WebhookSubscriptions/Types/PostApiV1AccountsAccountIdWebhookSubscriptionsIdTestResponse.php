<?php

namespace Leal\WebhookSubscriptions\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class PostApiV1AccountsAccountIdWebhookSubscriptionsIdTestResponse extends JsonSerializableType
{
    /**
     * @var bool $delivered True when your URL responded with a 2xx status
     */
    #[JsonProperty('delivered')]
    public bool $delivered;

    /**
     * @var string $error Why the delivery failed
     */
    #[JsonProperty('error')]
    public string $error;

    /**
     * @var string $eventId The `webhook-id` of the test event
     */
    #[JsonProperty('event_id')]
    public string $eventId;

    /**
     * @var float $status HTTP status your URL returned
     */
    #[JsonProperty('status')]
    public float $status;

    /**
     * @param array{
     *   delivered: bool,
     *   error: string,
     *   eventId: string,
     *   status: float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->delivered = $values['delivered'];
        $this->error = $values['error'];
        $this->eventId = $values['eventId'];
        $this->status = $values['status'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
