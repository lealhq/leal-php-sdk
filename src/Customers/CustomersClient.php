<?php

namespace Leal\Customers;

use Psr\Http\Client\ClientInterface;
use Leal\Core\Client\RawClient;
use Leal\Customers\Requests\ListCustomersRequest;
use Leal\Customers\Types\ListCustomersResponse;
use Leal\Exceptions\LealException;
use Leal\Exceptions\LealApiException;
use Leal\Core\Json\JsonApiRequest;
use Leal\Environments;
use Leal\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Leal\Customers\Requests\CreateCustomersRequest;
use Leal\Customers\Types\CreateCustomersResponse;
use Leal\Customers\Types\GetCustomersResponse;
use Leal\Customers\Requests\UpdateCustomersRequest;
use Leal\Customers\Types\UpdateCustomersResponse;

class CustomersClient
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
     * Returns a paginated list of customers for the store. Use the `search` parameter to filter
     * by name, email, phone, card code (barcode), or external reference ID. Alternatively, pass
     * `source` AND `external_id` together to perform an exact lookup by an external reference -
     * the response will contain at most one customer.
     *
     * Example:
     * ```php
     * $client->customers->list(
     *     1,
     *     new ListCustomersRequest([]),
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param ListCustomersRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListCustomersResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function list(int $accountId, ListCustomersRequest $request = new ListCustomersRequest(), ?array $options = null): ?ListCustomersResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->search != null) {
            $query['search'] = $request->search;
        }
        if ($request->source != null) {
            $query['source'] = $request->source;
        }
        if ($request->externalId != null) {
            $query['external_id'] = $request->externalId;
        }
        if ($request->page != null) {
            $query['page'] = $request->page;
        }
        if ($request->items != null) {
            $query['items'] = $request->items;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/customers",
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
                return ListCustomersResponse::fromJson($json);
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
     * Creates a new customer for the store. Requires `first_name` and at least one of `email` or `phone`.
     * Optionally enroll the customer in a loyalty card by passing `card_id`, and trigger delivery of
     * card links (email/SMS) by passing `send_card_links`. When a card with initial stamps is assigned,
     * those stamps are automatically applied as a welcome bonus.
     *
     * Pass `metadata` to attach arbitrary key/value data, and `external_references` to link the
     * customer to records in other systems (e.g. Square, Shopify). External references are upserted
     * by `(source, external_id)` so this endpoint is safe to call with the same references twice.
     *
     * Example:
     * ```php
     * $client->customers->create(
     *     1,
     *     new CreateCustomersRequest([
     *         'customer' => new CreateCustomersRequestCustomer([
     *             'firstName' => 'first_name',
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param CreateCustomersRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateCustomersResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function create(int $accountId, CreateCustomersRequest $request, ?array $options = null): ?CreateCustomersResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/customers",
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
                return CreateCustomersResponse::fromJson($json);
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
     * Returns detailed information about a single customer, including all of their
     * enrolled loyalty cards with stamp progress and wallet pass URLs (`apple_wallet_url`
     * and `google_wallet_url`) for each card. Also includes `metadata` and
     * `external_references` so you can sync state with external systems.
     *
     * Example:
     * ```php
     * $client->customers->get(
     *     1,
     *     1,
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param int $id Customer ID
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetCustomersResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function get(int $accountId, int $id, ?array $options = null): ?GetCustomersResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/customers/{$id}",
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
                return GetCustomersResponse::fromJson($json);
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
     * Updates an existing customer's details. To add stamps or redeem rewards, use the
     * customer cards endpoints instead.
     *
     * `metadata` is shallow-merged into the existing metadata. `external_references` are upserted
     * by `(source, external_id)` - to remove a reference, omit it from subsequent calls and use
     * a separate `DELETE` workflow (not yet exposed via API; manage in dashboard for now).
     *
     * Example:
     * ```php
     * $client->customers->update(
     *     1,
     *     1,
     *     new UpdateCustomersRequest([
     *         'customer' => new UpdateCustomersRequestCustomer([]),
     *     ]),
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param int $id Customer ID
     * @param UpdateCustomersRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateCustomersResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function update(int $accountId, int $id, UpdateCustomersRequest $request, ?array $options = null): ?UpdateCustomersResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/customers/{$id}",
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
                return UpdateCustomersResponse::fromJson($json);
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
