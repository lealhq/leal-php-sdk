<?php

namespace Leal\Posters;

use Psr\Http\Client\ClientInterface;
use Leal\Core\Client\RawClient;
use Leal\Posters\Requests\ListPostersRequest;
use Leal\Posters\Types\ListPostersResponseItem;
use Leal\Exceptions\LealException;
use Leal\Exceptions\LealApiException;
use Leal\Core\Json\JsonApiRequest;
use Leal\Environments;
use Leal\Core\Client\HttpMethod;
use Leal\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Leal\Posters\Requests\CreatePostersRequest;
use Leal\Posters\Types\CreatePostersResponse;
use Leal\Posters\Types\GetPostersResponse;
use Leal\Posters\Requests\UpdatePostersRequest;
use Leal\Posters\Types\UpdatePostersResponse;

class PostersClient
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
     * Returns all posters for the store. Optionally filter by card or active status.
     *
     * Example:
     * ```php
     * $client->posters->list(
     *     1,
     *     new ListPostersRequest([]),
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param ListPostersRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<ListPostersResponseItem>
     * @throws LealException
     * @throws LealApiException
     */
    public function list(int $accountId, ListPostersRequest $request = new ListPostersRequest(), ?array $options = null): ?array
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
                    path: "api/v1/accounts/{$accountId}/posters",
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
                return JsonDecoder::decodeArray($json, [ListPostersResponseItem::class]); // @phpstan-ignore-line
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
     * Creates a new printable QR code poster for customer signup. The poster will automatically
     * generate a unique public signup URL and QR code. The `card_id` is required on create to
     * associate the poster with a loyalty card.
     *
     * Example:
     * ```php
     * $client->posters->create(
     *     1,
     *     new CreatePostersRequest([
     *         'poster' => new CreatePostersRequestPoster([
     *             'cardId' => 1,
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param CreatePostersRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreatePostersResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function create(int $accountId, CreatePostersRequest $request, ?array $options = null): ?CreatePostersResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/posters",
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
                return CreatePostersResponse::fromJson($json);
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
     * Returns a single poster by ID, including generated signup and display URLs.
     *
     * Example:
     * ```php
     * $client->posters->get(
     *     1,
     *     1,
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param int $id Poster ID
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetPostersResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function get(int $accountId, int $id, ?array $options = null): ?GetPostersResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/posters/{$id}",
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
                return GetPostersResponse::fromJson($json);
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
     * Permanently deletes a poster. The public signup URL will stop working.
     *
     * Example:
     * ```php
     * $client->posters->delete(
     *     1,
     *     1,
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param int $id Poster ID
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
                    path: "api/v1/accounts/{$accountId}/posters/{$id}",
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
     * Updates an existing poster. The `card_id` cannot be changed after creation.
     *
     * Example:
     * ```php
     * $client->posters->update(
     *     1,
     *     1,
     *     new UpdatePostersRequest([
     *         'poster' => new UpdatePostersRequestPoster([]),
     *     ]),
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param int $id Poster ID
     * @param UpdatePostersRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdatePostersResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function update(int $accountId, int $id, UpdatePostersRequest $request, ?array $options = null): ?UpdatePostersResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/posters/{$id}",
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
                return UpdatePostersResponse::fromJson($json);
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
