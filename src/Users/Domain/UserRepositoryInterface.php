<?php

namespace Src\Users\Domain;

interface UserRepositoryInterface
{
    public function getAll(): array;
    public function getById(int $id): ?User;
    public function create(User $user): User;
    public function update(User $user): User;
//    public function deleteById(int $id): bool;

    public function checkUsernameUnique(string $username, int $ignoreId = null): bool;
    public function checkEmailUnique(string $email, int $ignoreId = null): bool;
}
