<?php

namespace Leal\CustomerCards;

use Psr\Http\Client\ClientInterface;
use Leal\Core\Client\RawClient;
use Leal\CustomerCards\Types\ListCustomerCardsResponseItem;
use Leal\Exceptions\LealException;
use Leal\Exceptions\LealApiException;
use Leal\Core\Json\JsonApiRequest;
use Leal\Environments;
use Leal\Core\Client\HttpMethod;
use Leal\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Leal\CustomerCards\Types\GetCustomerCardsResponse;
use Leal\CustomerCards\Requests\RedeemCustomerCardsRequest;
use Leal\CustomerCards\Types\RedeemCustomerCardsResponse;
use Leal\CustomerCards\Requests\StampCustomerCardsRequest;
use Leal\CustomerCards\Types\StampCustomerCardsResponse;

class CustomerCardsClient
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
     * Returns all loyalty cards enrolled for a specific customer, including stamp progress,
     * status, wallet pass installation state, and wallet pass URLs (`apple_wallet_url` and
     * `google_wallet_url`) that you can use to let customers add their loyalty card to
     * Apple Wallet or Google Wallet from your own app or website.
     *
     * Example:
     * ```php
     * $client->customerCards->list(
     *     1,
     *     1,
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param int $customerId Customer ID
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<ListCustomerCardsResponseItem>
     * @throws LealException
     * @throws LealApiException
     */
    public function list(int $accountId, int $customerId, ?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/customers/{$customerId}/customer_cards",
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
                return JsonDecoder::decodeArray($json, [ListCustomerCardsResponseItem::class]); // @phpstan-ignore-line
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
     * Returns detailed information about a specific customer card, including stamp progress,
     * a list of rewards the customer has earned enough stamps to redeem, and wallet pass URLs
     * (`apple_wallet_url` and `google_wallet_url`) for adding the card to Apple Wallet or
     * Google Wallet.
     *
     * Example:
     * ```php
     * $client->customerCards->get(
     *     1,
     *     1,
     *     1,
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param int $customerId Customer ID
     * @param int $id Customer card ID
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetCustomerCardsResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function get(int $accountId, int $customerId, int $id, ?array $options = null): ?GetCustomerCardsResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/customers/{$customerId}/customer_cards/{$id}",
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
                return GetCustomerCardsResponse::fromJson($json);
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
     * Redeems a reward for a customer, deducting the required stamps from their card.
     * The customer must have enough stamps on this card to cover the reward's cost.
     * Triggers wallet pass updates and push notifications.
     *
     * Example:
     * ```php
     * $client->customerCards->redeem(
     *     1,
     *     1,
     *     1,
     *     new RedeemCustomerCardsRequest([
     *         'rewardId' => 1,
     *     ]),
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param int $customerId Customer ID
     * @param int $id Customer card ID
     * @param RedeemCustomerCardsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?RedeemCustomerCardsResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function redeem(int $accountId, int $customerId, int $id, RedeemCustomerCardsRequest $request, ?array $options = null): ?RedeemCustomerCardsResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/customers/{$customerId}/customer_cards/{$id}/redeem",
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
                return RedeemCustomerCardsResponse::fromJson($json);
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
     * Adds stamps to a customer's loyalty card. Triggers ledger entries, wallet pass updates,
     * and push notifications. Pass `skip_notifications` to stamp silently.
     *
     * Example:
     * ```php
     * $client->customerCards->stamp(
     *     1,
     *     1,
     *     1,
     *     new StampCustomerCardsRequest([
     *         'stamps' => 1,
     *     ]),
     * );
     * ```
     *
     * @param int $accountId Store (account) ID
     * @param int $customerId Customer ID
     * @param int $id Customer card ID
     * @param StampCustomerCardsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?StampCustomerCardsResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function stamp(int $accountId, int $customerId, int $id, StampCustomerCardsRequest $request, ?array $options = null): ?StampCustomerCardsResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/accounts/{$accountId}/customers/{$customerId}/customer_cards/{$id}/stamp",
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
                return StampCustomerCardsResponse::fromJson($json);
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
