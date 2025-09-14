<?php

namespace Src\Applications\Domain\DTO;

use JsonSerializable;
use Src\Applications\Infrastructure\Eloquent\ApplicationModel;
use Src\Users\Domain\User;

class ApplicationResponse  implements JsonSerializable
{
    public function __construct(
        private ApplicationModel $model,
    ) {}

//    public static function fromArray(array $entities)
//    {
//        return array_map(fn ($e) => new self($e), $entities);
//    }

    public static function fromArray(array $entities)
    {
        return array_map(fn ($e) => new self($e), $entities);
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->model->id,
            'name' => $this->model->name,
            'url' => $this->model->url,
            'is_active' => $this->model->is_active
        ];
    }
}
