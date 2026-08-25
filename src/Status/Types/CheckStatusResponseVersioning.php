<?php

namespace Leal\Status\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;
use Leal\Core\Types\ArrayType;

class CheckStatusResponseVersioning extends JsonSerializableType
{
    /**
     * @var string $current The version to build against
     */
    #[JsonProperty('current')]
    public string $current;

    /**
     * @var array<string> $deprecated Versions that are deprecated but still serving
     */
    #[JsonProperty('deprecated'), ArrayType(['string'])]
    public array $deprecated;

    /**
     * @var string $policyUrl The published versioning and deprecation policy
     */
    #[JsonProperty('policy_url')]
    public string $policyUrl;

    /**
     * @var string $signalling The headers a deprecated version sends
     */
    #[JsonProperty('signalling')]
    public string $signalling;

    /**
     * @var array<string> $supported Every version still serving requests
     */
    #[JsonProperty('supported'), ArrayType(['string'])]
    public array $supported;

    /**
     * @param array{
     *   current: string,
     *   deprecated: array<string>,
     *   policyUrl: string,
     *   signalling: string,
     *   supported: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->current = $values['current'];
        $this->deprecated = $values['deprecated'];
        $this->policyUrl = $values['policyUrl'];
        $this->signalling = $values['signalling'];
        $this->supported = $values['supported'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
