<?php

namespace Leal;

use Leal\Stores\StoresClient;
use Leal\Cards\CardsClient;
use Leal\Customers\CustomersClient;
use Leal\CustomerCards\CustomerCardsClient;
use Leal\Locations\LocationsClient;
use Leal\Posters\PostersClient;
use Leal\Rewards\RewardsClient;
use Leal\Status\StatusClient;
use Psr\Http\Client\ClientInterface;
use Leal\Core\Client\RawClient;

class LealClient
{
    /**
     * @var StoresClient $stores
     */
    public StoresClient $stores;

    /**
     * @var CardsClient $cards
     */
    public CardsClient $cards;

    /**
     * @var CustomersClient $customers
     */
    public CustomersClient $customers;

    /**
     * @var CustomerCardsClient $customerCards
     */
    public CustomerCardsClient $customerCards;

    /**
     * @var LocationsClient $locations
     */
    public LocationsClient $locations;

    /**
     * @var PostersClient $posters
     */
    public PostersClient $posters;

    /**
     * @var RewardsClient $rewards
     */
    public RewardsClient $rewards;

    /**
     * @var StatusClient $status
     */
    public StatusClient $status;

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
     * @param string $token The token to use for authentication.
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        string $token,
        ?array $options = null,
    ) {
        $defaultHeaders = [
            'Authorization' => "Bearer $token",
            'X-Fern-Language' => 'PHP',
            'X-Fern-SDK-Name' => 'Leal',
            'X-Fern-SDK-Version' => '0.0.7',
            'User-Agent' => 'lealhq/leal/0.0.7',
        ];

        $this->options = $options ?? [];

        $this->options['headers'] = array_merge(
            $defaultHeaders,
            $this->options['headers'] ?? [],
        );

        $this->client = new RawClient(
            options: $this->options,
        );

        $this->stores = new StoresClient($this->client, $this->options);
        $this->cards = new CardsClient($this->client, $this->options);
        $this->customers = new CustomersClient($this->client, $this->options);
        $this->customerCards = new CustomerCardsClient($this->client, $this->options);
        $this->locations = new LocationsClient($this->client, $this->options);
        $this->posters = new PostersClient($this->client, $this->options);
        $this->rewards = new RewardsClient($this->client, $this->options);
        $this->status = new StatusClient($this->client, $this->options);
    }
}
