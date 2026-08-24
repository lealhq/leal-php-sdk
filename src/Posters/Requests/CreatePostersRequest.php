<?php

namespace Leal\Posters\Requests;

use Leal\Core\Json\JsonSerializableType;
use Leal\Posters\Types\CreatePostersRequestPoster;
use Leal\Core\Json\JsonProperty;

class CreatePostersRequest extends JsonSerializableType
{
    /**
     * @var CreatePostersRequestPoster $poster
     */
    #[JsonProperty('poster')]
    public CreatePostersRequestPoster $poster;

    /**
     * @param array{
     *   poster: CreatePostersRequestPoster,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->poster = $values['poster'];
    }
}
