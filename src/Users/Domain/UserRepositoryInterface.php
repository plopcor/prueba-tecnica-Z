<?php

namespace Src\Users\Domain;

interface UserRepositoryInterface
{
    public function getAll(): array;
    public function getById(int $id): ?User;
    public function create(): User;
    public function update(User $user): User;
//    public function deleteById(int $id): bool;
}
