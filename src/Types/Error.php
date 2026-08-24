<?php

namespace Leal\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;
use Leal\Core\Types\Union;

/**
 * A JSON error payload. Agents should read `error` for a human readable summary and `errors` for per field validation messages when present.
 */
class Error extends JsonSerializableType
{
    /**
     * @var ?string $error Human readable description of what went wrong.
     */
    #[JsonProperty('error')]
    public ?string $error;

    /**
     * @var (
     *    array<string>
     *   |array<string, array<string>>
     * )|null $errors Validation messages, either a list of strings or an object keyed by field name.
     */
    #[JsonProperty('errors'), Union(['string'], ['string' => ['string']], 'null')]
    public array|null $errors;

    /**
     * @param array{
     *   error?: ?string,
     *   errors?: (
     *    array<string>
     *   |array<string, array<string>>
     * )|null,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->error = $values['error'] ?? null;
        $this->errors = $values['errors'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
