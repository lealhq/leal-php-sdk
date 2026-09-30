<?php

namespace Leal\WebhookSubscriptions\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;
use Leal\Core\Types\ArrayType;

class GetApiV1AccountsAccountIdWebhookSubscriptionsResponseItem extends JsonSerializableType
{
    /**
     * @var int $accountId Parent store ID
     */
    #[JsonProperty('account_id')]
    public int $accountId;

    /**
     * @var string $createdAt ISO 8601 creation timestamp
     */
    #[JsonProperty('created_at')]
    public string $createdAt;

    /**
     * @var string $description Your own label for the subscription
     */
    #[JsonProperty('description')]
    public string $description;

    /**
     * @var string $disabledAt ISO 8601 time the subscription was disabled
     */
    #[JsonProperty('disabled_at')]
    public string $disabledAt;

    /**
     * @var string $disabledReason `disabled_by_user`, `failing` or `blocked_address`
     */
    #[JsonProperty('disabled_reason')]
    public string $disabledReason;

    /**
     * @var bool $enabled Whether events are being delivered
     */
    #[JsonProperty('enabled')]
    public bool $enabled;

    /**
     * @var string $event The event, when there is exactly one (kept for older integrations)
     */
    #[JsonProperty('event')]
    public string $event;

    /**
     * @var array<string> $events Events delivered to this URL, or `["*"]` for every event
     */
    #[JsonProperty('events'), ArrayType(['string'])]
    public array $events;

    /**
     * @var int $id Unique subscription ID
     */
    #[JsonProperty('id')]
    public int $id;

    /**
     * @var string $lastDeliveryAt ISO 8601 time of the most recent delivery attempt
     */
    #[JsonProperty('last_delivery_at')]
    public string $lastDeliveryAt;

    /**
     * @var string $lastDeliveryError Why the most recent attempt failed
     */
    #[JsonProperty('last_delivery_error')]
    public string $lastDeliveryError;

    /**
     * @var float $lastDeliveryStatus HTTP status your URL returned on the most recent attempt
     */
    #[JsonProperty('last_delivery_status')]
    public float $lastDeliveryStatus;

    /**
     * @var string $payloadFormat `envelope` (default) or `flat` (the bare data object, used by Zapier)
     */
    #[JsonProperty('payload_format')]
    public string $payloadFormat;

    /**
     * @var string $targetUrl URL that receives the POST requests
     */
    #[JsonProperty('target_url')]
    public string $targetUrl;

    /**
     * @var string $updatedAt ISO 8601 last-update timestamp
     */
    #[JsonProperty('updated_at')]
    public string $updatedAt;

    /**
     * @param array{
     *   accountId: int,
     *   createdAt: string,
     *   description: string,
     *   disabledAt: string,
     *   disabledReason: string,
     *   enabled: bool,
     *   event: string,
     *   events: array<string>,
     *   id: int,
     *   lastDeliveryAt: string,
     *   lastDeliveryError: string,
     *   lastDeliveryStatus: float,
     *   payloadFormat: string,
     *   targetUrl: string,
     *   updatedAt: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->accountId = $values['accountId'];
        $this->createdAt = $values['createdAt'];
        $this->description = $values['description'];
        $this->disabledAt = $values['disabledAt'];
        $this->disabledReason = $values['disabledReason'];
        $this->enabled = $values['enabled'];
        $this->event = $values['event'];
        $this->events = $values['events'];
        $this->id = $values['id'];
        $this->lastDeliveryAt = $values['lastDeliveryAt'];
        $this->lastDeliveryError = $values['lastDeliveryError'];
        $this->lastDeliveryStatus = $values['lastDeliveryStatus'];
        $this->payloadFormat = $values['payloadFormat'];
        $this->targetUrl = $values['targetUrl'];
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
