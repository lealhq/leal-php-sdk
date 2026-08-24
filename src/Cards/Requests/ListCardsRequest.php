<?php

namespace Leal\Cards\Requests;

use Leal\Core\Json\JsonSerializableType;

class ListCardsRequest extends JsonSerializableType
{
    /**
     * @var ?string $scope Filter cards by archive status. Default: active only.
     */
    public ?string $scope;

    /**
     * @param array{
     *   scope?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->scope = $values['scope'] ?? null;
    }
}
