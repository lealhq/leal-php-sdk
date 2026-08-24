<?php

namespace Leal\Customers\Requests;

use Leal\Core\Json\JsonSerializableType;

class ListCustomersRequest extends JsonSerializableType
{
    /**
     * @var ?string $search Search query to filter customers by name, email, phone, card code (barcode), or external reference ID
     */
    public ?string $search;

    /**
     * @var ?string $source External system slug (e.g. `square`, `shopify`). When combined with `external_id`, performs an exact lookup.
     */
    public ?string $source;

    /**
     * @var ?string $externalId External system's identifier for the customer. Must be combined with `source`.
     */
    public ?string $externalId;

    /**
     * @var ?int $page Page number (defaults to 1)
     */
    public ?int $page;

    /**
     * @var ?int $items Number of items per page
     */
    public ?int $items;

    /**
     * @param array{
     *   search?: ?string,
     *   source?: ?string,
     *   externalId?: ?string,
     *   page?: ?int,
     *   items?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->search = $values['search'] ?? null;
        $this->source = $values['source'] ?? null;
        $this->externalId = $values['externalId'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->items = $values['items'] ?? null;
    }
}
