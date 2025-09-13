<?php

namespace Src\Users\Domain\DTO;

use JsonSerializable;
use Src\Users\Domain\User;

class UserResponse  implements JsonSerializable
{
    public function __construct(
        private User $user,
    ) {}

    public static function fromArray(array $entities)
    {
        return array_map(fn ($e) => new self($e), $entities);
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->user->getId(),
            'username' => $this->user->getUsername(),
            'name' => $this->user->getName(),
            'surname' => $this->user->getSurname(),
            'email' => $this->user->getEmail(),
            'hire_date' => $this->user->getHireDate(),
            'department' => $this->user->getDepartment(),
            'position' => $this->user->getPosition(),
            'is_admin' => $this->user->isAdmin(),
            'applications' => $this->user->getApplicationIds()
        ];
    }
}
