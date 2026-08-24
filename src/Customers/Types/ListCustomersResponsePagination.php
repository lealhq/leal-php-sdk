<?php

namespace Leal\Customers\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class ListCustomersResponsePagination extends JsonSerializableType
{
    /**
     * @var int $count Total customers matching the query
     */
    #[JsonProperty('count')]
    public int $count;

    /**
     * @var int $items Customers per page
     */
    #[JsonProperty('items')]
    public int $items;

    /**
     * @var int $page Current page number
     */
    #[JsonProperty('page')]
    public int $page;

    /**
     * @var int $pages Total number of pages
     */
    #[JsonProperty('pages')]
    public int $pages;

    /**
     * @param array{
     *   count: int,
     *   items: int,
     *   page: int,
     *   pages: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->count = $values['count'];
        $this->items = $values['items'];
        $this->page = $values['page'];
        $this->pages = $values['pages'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
