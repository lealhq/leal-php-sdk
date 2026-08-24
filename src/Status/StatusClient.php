<?php

namespace Leal\Status;

use Psr\Http\Client\ClientInterface;
use Leal\Core\Client\RawClient;
use Leal\Status\Types\CheckStatusResponse;
use Leal\Exceptions\LealException;
use Leal\Exceptions\LealApiException;
use Leal\Core\Json\JsonApiRequest;
use Leal\Environments;
use Leal\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class StatusClient
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
     * Returns the status of the API. No authentication required.
     *
     * Every response from this API, including this one, carries `RateLimit-Limit`,
     * `RateLimit-Remaining`, `RateLimit-Reset` and `RateLimit-Policy`. Exceeding
     * the limit returns 429 with `Retry-After` in seconds.
     *
     * Example:
     * ```php
     * $client->status->check();
     * ```
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CheckStatusResponse
     * @throws LealException
     * @throws LealApiException
     */
    public function check(?array $options = null): ?CheckStatusResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/v1/status",
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
                return CheckStatusResponse::fromJson($json);
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
