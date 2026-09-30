<?php

namespace Leal\WebhookSubscriptions\Requests;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;
use Leal\Core\Types\ArrayType;

class PatchApiV1AccountsAccountIdWebhookSubscriptionsIdRequest extends JsonSerializableType
{
    /**
     * @var ?string $description Your own label, up to 255 characters
     */
    #[JsonProperty('description')]
    public ?string $description;

    /**
     * @var ?bool $enabled false to pause deliveries, true to resume them
     */
    #[JsonProperty('enabled')]
    public ?bool $enabled;

    /**
     * @var ?string $event A single event. Same as `events` with one entry
     */
    #[JsonProperty('event')]
    public ?string $event;

    /**
     * @var ?array<string> $events Replaces the list of events, or `["*"]` for every event
     */
    #[JsonProperty('events'), ArrayType(['string'])]
    public ?array $events;

    /**
     * @var ?string $payloadFormat `envelope` or `flat`
     */
    #[JsonProperty('payload_format')]
    public ?string $payloadFormat;

    /**
     * @var ?string $targetUrl Public https URL that will receive the POST requests
     */
    #[JsonProperty('target_url')]
    public ?string $targetUrl;

    /**
     * @param array{
     *   description?: ?string,
     *   enabled?: ?bool,
     *   event?: ?string,
     *   events?: ?array<string>,
     *   payloadFormat?: ?string,
     *   targetUrl?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->description = $values['description'] ?? null;
        $this->enabled = $values['enabled'] ?? null;
        $this->event = $values['event'] ?? null;
        $this->events = $values['events'] ?? null;
        $this->payloadFormat = $values['payloadFormat'] ?? null;
        $this->targetUrl = $values['targetUrl'] ?? null;
    }
}
