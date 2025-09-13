<?php

namespace Src\Users\Domain\DTO;

use JsonSerializable;
use Src\Users\Domain\User;

class UserListResponse  implements JsonSerializable
{
    public function __construct(
        private User $user
    ) {}

    public static function fromArray(array $entities)
    {
        return array_map(fn($e) => new self($e), $entities);
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->user->getId(),
            'username' => $this->user->getUsername(),
            'email' => $this->user->getEmail(),
            'name' => $this->user->getName(),
            'surname' => $this->user->getSurname(),
        ];
    }
}
