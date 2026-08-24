<?php

namespace Leal\Posters\Requests;

use Leal\Core\Json\JsonSerializableType;
use Leal\Posters\Types\UpdatePostersRequestPoster;
use Leal\Core\Json\JsonProperty;

class UpdatePostersRequest extends JsonSerializableType
{
    /**
     * @var UpdatePostersRequestPoster $poster
     */
    #[JsonProperty('poster')]
    public UpdatePostersRequestPoster $poster;

    /**
     * @param array{
     *   poster: UpdatePostersRequestPoster,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->poster = $values['poster'];
    }
}
