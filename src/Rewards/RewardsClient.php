<?php

namespace Leal\Rewards;

use Psr\Http\Client\ClientInterface;
use Leal\Core\Client\RawClient;
use Leal\Rewards\Requests\ListRewardsRequest;
use Leal\Rewards\Types\ListRewardsResponseItem;
use Leal\Exceptions\LealException;
use Leal\Exceptions\LealApiException;
use Leal\Core\Json\JsonApiRequest;
use Leal\Environments;
use Leal\Core\Client\HttpMethod;
use Leal\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Leal\Rewards\Requests\CreateRewardsRequest;
use Leal\Rewards\Types\CreateRewardsResponse;
use Leal\Rewards\Types\GetRewardsResponse;
use Leal\Rewards\Requests\UpdateRewardsRequest;
use Leal\Rewards\Types\UpdateRewardsResponse;

class RewardsClient
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
     * Returns all rewards for the store. Optionally filter by card or active status.
     *
     * Example:
     * ```php
     * $client->rewards->list(
     *     1,
     *     new ListRewardsRequest([]),
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param ListRewardsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<ListRewardsResponseItem>
     * @throws LealException
     * @throws LealApiException
     */
    public function list(int $accountId, ListRewardsRequest $request = new ListRewardsRequest(), ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->cardId != null) {
            $query['card_id'] = $request->cardId;
        }
        if ($request->active != null) {
            $query['active'] = $request->active;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/rewards",
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
                return JsonDecoder::decodeArray($json, [ListRewardsResponseItem::class]); // @phpstan-ignore-line
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
     * Creates a new reward for a loyalty card. The card must belong to the same store.
     * The `card_id` is required on create but cannot be changed afterwards.
     *
     * Example:
     * ```php
     * $client->rewards->create(
     *     1,
     *     new CreateRewardsRequest([
     *         'reward' => new CreateRewardsRequestReward([
     *             'cardId' => 1,
     *             'name' => 'name',
     *             'stampsRequired' => 1,
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param CreateRewardsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateRewardsResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function create(int $accountId, CreateRewardsRequest $request, ?array $options = null): ?CreateRewardsResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/rewards",
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
                return CreateRewardsResponse::fromJson($json);
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
     * Returns a single reward by ID.
     *
     * Example:
     * ```php
     * $client->rewards->get(
     *     1,
     *     1,
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param int $id Reward ID
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetRewardsResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function get(int $accountId, int $id, ?array $options = null): ?GetRewardsResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/rewards/{$id}",
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
                return GetRewardsResponse::fromJson($json);
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
     * Permanently deletes a reward. This cannot be undone.
     *
     * Example:
     * ```php
     * $client->rewards->delete(
     *     1,
     *     1,
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param int $id Reward ID
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
    public function delete(int $accountId, int $id, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/rewards/{$id}",
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
     * Updates an existing reward. The `card_id` cannot be changed after creation.
     *
     * Example:
     * ```php
     * $client->rewards->update(
     *     1,
     *     1,
     *     new UpdateRewardsRequest([
     *         'reward' => new UpdateRewardsRequestReward([]),
     *     ]),
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param int $id Reward ID
     * @param UpdateRewardsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateRewardsResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function update(int $accountId, int $id, UpdateRewardsRequest $request, ?array $options = null): ?UpdateRewardsResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/rewards/{$id}",
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
                return UpdateRewardsResponse::fromJson($json);
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
