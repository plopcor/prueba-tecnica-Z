<?php

namespace Src\Users\Application;

use App\Models\User;
use Src\Shared\Domain\Exceptions\EntityValidationException;
use Src\Shared\Domain\Exceptions\UserIsNotAdminException;
use Src\Users\Domain\UserRepositoryInterface;

final class CreateUser
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) { }

    public function __invoke(User $user, array $userData): array {

        if (!$user->is_admin) {
            throw new UserIsNotAdminException();
        }

        // TODO: Validate unique fields
        if (false) {
            throw new EntityValidationException("Username already exists");
        }

        return $this->userRepository->create($userData);
    }
}
