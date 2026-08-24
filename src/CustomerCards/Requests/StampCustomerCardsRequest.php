<?php

namespace Leal\CustomerCards\Requests;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class StampCustomerCardsRequest extends JsonSerializableType
{
    /**
     * @var ?bool $skipNotifications When true, stamp changes bypass notifications
     */
    #[JsonProperty('skip_notifications')]
    public ?bool $skipNotifications;

    /**
     * @var int $stamps Number of stamps to add (e.g. 1, 3)
     */
    #[JsonProperty('stamps')]
    public int $stamps;

    /**
     * @param array{
     *   stamps: int,
     *   skipNotifications?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->skipNotifications = $values['skipNotifications'] ?? null;
        $this->stamps = $values['stamps'];
    }
}
