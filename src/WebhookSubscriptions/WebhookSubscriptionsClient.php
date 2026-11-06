<?php

namespace Leal\WebhookSubscriptions;

use Psr\Http\Client\ClientInterface;
use Leal\Core\Client\RawClient;
use Leal\WebhookSubscriptions\Requests\GetApiV1AccountsAccountIdWebhookSubscriptionsRequest;
use Leal\WebhookSubscriptions\Types\GetApiV1AccountsAccountIdWebhookSubscriptionsResponseItem;
use Leal\Exceptions\LealException;
use Leal\Exceptions\LealApiException;
use Leal\Core\Json\JsonApiRequest;
use Leal\Environments;
use Leal\Core\Client\HttpMethod;
use Leal\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Leal\WebhookSubscriptions\Requests\PostApiV1AccountsAccountIdWebhookSubscriptionsRequest;
use Leal\WebhookSubscriptions\Types\PostApiV1AccountsAccountIdWebhookSubscriptionsResponse;
use Leal\WebhookSubscriptions\Types\GetApiV1AccountsAccountIdWebhookSubscriptionsIdResponse;
use Leal\WebhookSubscriptions\Requests\PatchApiV1AccountsAccountIdWebhookSubscriptionsIdRequest;
use Leal\WebhookSubscriptions\Types\PatchApiV1AccountsAccountIdWebhookSubscriptionsIdResponse;
use Leal\WebhookSubscriptions\Types\PostApiV1AccountsAccountIdWebhookSubscriptionsIdRotateSecretResponse;
use Leal\WebhookSubscriptions\Types\PostApiV1AccountsAccountIdWebhookSubscriptionsIdTestResponse;

class WebhookSubscriptionsClient
{
    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options @phpstan-ignore-next-line Property is used in endpoint methods via HttpEndpointGenerator
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
    ) {
        $this->client = $client;
        $this->options = $options ?? [];
    }

    /**
     * Returns every webhook subscription for the store, oldest first. Signing secrets are not included; fetch a single subscription to read its secret.
     *
     * Example:
     * ```php
     * $client->webhookSubscriptions->getApiV1AccountsAccountIdWebhookSubscriptions(
     *     1,
     *     new GetApiV1AccountsAccountIdWebhookSubscriptionsRequest([]),
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param GetApiV1AccountsAccountIdWebhookSubscriptionsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<GetApiV1AccountsAccountIdWebhookSubscriptionsResponseItem>
     * @throws LealException
     * @throws LealApiException
     */
    public function getApiV1AccountsAccountIdWebhookSubscriptions(int $accountId, GetApiV1AccountsAccountIdWebhookSubscriptionsRequest $request = new GetApiV1AccountsAccountIdWebhookSubscriptionsRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->event != null) {
            $query['event'] = $request->event;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/webhook_subscriptions",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return JsonDecoder::decodeArray($json, [GetApiV1AccountsAccountIdWebhookSubscriptionsResponseItem::class]); // @phpstan-ignore-line
            }
        } catch (JsonException $e) {
            throw new LealException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new LealException(message: $e->getMessage(), previous: $e);
        }
        throw new LealApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Subscribes a URL to one or more events. The response includes the signing `secret`; store it to
     * verify deliveries. The URL must be publicly reachable over https.
     *
     * Events: `customer.created`, `customer.updated`, `customer_card.created`, `stamp.earned`, `stamp.removed`, `reward.unlocked`, `reward.redeemed`, `referral.created`, `referral.rewarded`, or `*` for all of them.
     *
     * Example:
     * ```php
     * $client->webhookSubscriptions->postApiV1AccountsAccountIdWebhookSubscriptions(
     *     1,
     *     new PostApiV1AccountsAccountIdWebhookSubscriptionsRequest([
     *         'targetUrl' => 'target_url',
     *     ]),
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param PostApiV1AccountsAccountIdWebhookSubscriptionsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PostApiV1AccountsAccountIdWebhookSubscriptionsResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function postApiV1AccountsAccountIdWebhookSubscriptions(int $accountId, PostApiV1AccountsAccountIdWebhookSubscriptionsRequest $request, ?array $options = null): ?PostApiV1AccountsAccountIdWebhookSubscriptionsResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/webhook_subscriptions",
                    method: HttpMethod::POST,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return PostApiV1AccountsAccountIdWebhookSubscriptionsResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new LealException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new LealException(message: $e->getMessage(), previous: $e);
        }
        throw new LealApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Returns a single subscription, including its signing secret and the result of the most recent delivery.
     *
     * Example:
     * ```php
     * $client->webhookSubscriptions->getApiV1AccountsAccountIdWebhookSubscriptionsId(
     *     1,
     *     1,
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param int $id Webhook subscription ID
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetApiV1AccountsAccountIdWebhookSubscriptionsIdResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function getApiV1AccountsAccountIdWebhookSubscriptionsId(int $accountId, int $id, ?array $options = null): ?GetApiV1AccountsAccountIdWebhookSubscriptionsIdResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/webhook_subscriptions/{$id}",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return GetApiV1AccountsAccountIdWebhookSubscriptionsIdResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new LealException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new LealException(message: $e->getMessage(), previous: $e);
        }
        throw new LealApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Stops deliveries and deletes the subscription. This cannot be undone.
     *
     * Example:
     * ```php
     * $client->webhookSubscriptions->deleteApiV1AccountsAccountIdWebhookSubscriptionsId(
     *     1,
     *     1,
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param int $id Webhook subscription ID
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @throws LealException
     * @throws LealApiException
     */
    public function deleteApiV1AccountsAccountIdWebhookSubscriptionsId(int $accountId, int $id, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/webhook_subscriptions/{$id}",
                    method: HttpMethod::DELETE,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return;
            }
        } catch (ClientExceptionInterface $e) {
            throw new LealException(message: $e->getMessage(), previous: $e);
        }
        throw new LealApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Changes the URL, events, label or payload format, or turns the subscription off and on. Re-enabling a subscription that was disabled for failing clears its failure state.
     *
     * Example:
     * ```php
     * $client->webhookSubscriptions->patchApiV1AccountsAccountIdWebhookSubscriptionsId(
     *     1,
     *     1,
     *     new PatchApiV1AccountsAccountIdWebhookSubscriptionsIdRequest([]),
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param int $id Webhook subscription ID
     * @param PatchApiV1AccountsAccountIdWebhookSubscriptionsIdRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PatchApiV1AccountsAccountIdWebhookSubscriptionsIdResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function patchApiV1AccountsAccountIdWebhookSubscriptionsId(int $accountId, int $id, PatchApiV1AccountsAccountIdWebhookSubscriptionsIdRequest $request = new PatchApiV1AccountsAccountIdWebhookSubscriptionsIdRequest(), ?array $options = null): ?PatchApiV1AccountsAccountIdWebhookSubscriptionsIdResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/webhook_subscriptions/{$id}",
                    method: HttpMethod::PATCH,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return PatchApiV1AccountsAccountIdWebhookSubscriptionsIdResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new LealException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new LealException(message: $e->getMessage(), previous: $e);
        }
        throw new LealApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Replaces the subscription's signing secret. Deliveries are signed with the new secret straight away, so update your receiver at the same time.
     *
     * Example:
     * ```php
     * $client->webhookSubscriptions->postApiV1AccountsAccountIdWebhookSubscriptionsIdRotateSecret(
     *     1,
     *     1,
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param int $id Webhook subscription ID
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PostApiV1AccountsAccountIdWebhookSubscriptionsIdRotateSecretResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function postApiV1AccountsAccountIdWebhookSubscriptionsIdRotateSecret(int $accountId, int $id, ?array $options = null): ?PostApiV1AccountsAccountIdWebhookSubscriptionsIdRotateSecretResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/webhook_subscriptions/{$id}/rotate_secret",
                    method: HttpMethod::POST,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return PostApiV1AccountsAccountIdWebhookSubscriptionsIdRotateSecretResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new LealException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new LealException(message: $e->getMessage(), previous: $e);
        }
        throw new LealApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Immediately sends a signed `webhook.test` event to the subscription's URL and reports what
     * happened, so you can check your endpoint and signature verification without waiting for real
     * activity. Test events are not retried and do not count towards disabling the subscription.
     *
     * Example:
     * ```php
     * $client->webhookSubscriptions->postApiV1AccountsAccountIdWebhookSubscriptionsIdTest(
     *     1,
     *     1,
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param int $id Webhook subscription ID
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PostApiV1AccountsAccountIdWebhookSubscriptionsIdTestResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function postApiV1AccountsAccountIdWebhookSubscriptionsIdTest(int $accountId, int $id, ?array $options = null): ?PostApiV1AccountsAccountIdWebhookSubscriptionsIdTestResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/webhook_subscriptions/{$id}/test",
                    method: HttpMethod::POST,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return PostApiV1AccountsAccountIdWebhookSubscriptionsIdTestResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new LealException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new LealException(message: $e->getMessage(), previous: $e);
        }
        throw new LealApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }
}
