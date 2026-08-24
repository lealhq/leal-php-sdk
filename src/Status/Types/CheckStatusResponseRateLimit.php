<?php

namespace Leal\Status\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class CheckStatusResponseRateLimit extends JsonSerializableType
{
    /**
     * @var int $limit Requests allowed per window
     */
    #[JsonProperty('limit')]
    public int $limit;

    /**
     * @var string $scope What the limit is counted against
     */
    #[JsonProperty('scope')]
    public string $scope;

    /**
     * @var int $windowSeconds Length of the window in seconds
     */
    #[JsonProperty('window_seconds')]
    public int $windowSeconds;

    /**
     * @param array{
     *   limit: int,
     *   scope: string,
     *   windowSeconds: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->limit = $values['limit'];
        $this->scope = $values['scope'];
        $this->windowSeconds = $values['windowSeconds'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
