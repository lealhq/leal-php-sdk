<?php

namespace Leal\WebhookSubscriptions\Requests;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;
use Leal\Core\Types\ArrayType;

class PostApiV1AccountsAccountIdWebhookSubscriptionsRequest extends JsonSerializableType
{
    /**
     * @var ?string $description Your own label, up to 255 characters
     */
    #[JsonProperty('description')]
    public ?string $description;

    /**
     * @var ?bool $enabled Create the subscription disabled by passing false (defaults to true)
     */
    #[JsonProperty('enabled')]
    public ?bool $enabled;

    /**
     * @var ?string $event A single event to subscribe to. Same as `events` with one entry
     */
    #[JsonProperty('event')]
    public ?string $event;

    /**
     * @var ?array<string> $events Events to subscribe to, or `["*"]` for every event. Required unless `event` is given
     */
    #[JsonProperty('events'), ArrayType(['string'])]
    public ?array $events;

    /**
     * @var ?string $payloadFormat `envelope` (default) or `flat`. `flat` sends the bare data object and cannot be combined with `*`
     */
    #[JsonProperty('payload_format')]
    public ?string $payloadFormat;

    /**
     * @var string $targetUrl Public https URL that will receive the POST requests
     */
    #[JsonProperty('target_url')]
    public string $targetUrl;

    /**
     * @param array{
     *   targetUrl: string,
     *   description?: ?string,
     *   enabled?: ?bool,
     *   event?: ?string,
     *   events?: ?array<string>,
     *   payloadFormat?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->description = $values['description'] ?? null;
        $this->enabled = $values['enabled'] ?? null;
        $this->event = $values['event'] ?? null;
        $this->events = $values['events'] ?? null;
        $this->payloadFormat = $values['payloadFormat'] ?? null;
        $this->targetUrl = $values['targetUrl'];
    }
}
