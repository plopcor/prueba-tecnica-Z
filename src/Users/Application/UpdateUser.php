<?php

namespace Src\Users\Application;

use App\Models\User as UserModel;
use Src\Shared\Domain\Exceptions\EntityNotFoundException;
use Src\Users\Domain\User;
use Src\Shared\Domain\Exceptions\EntityValidationException;
use Src\Shared\Domain\Exceptions\UserIsNotAdminException;
use Src\Users\Domain\UserRepositoryInterface;

final class UpdateUser
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) { }

    public function __invoke(UserModel $user, User $userData): User {

        if (!$user->is_admin) {
            throw new UserIsNotAdminException();
        }

        if (! $this->userRepository->checkExists($userData->getId())) {
            throw new EntityNotFoundException("User does not exist");
        }

        if (! $this->userRepository->checkUsernameUnique($userData->getUsername(), $userData->getId())) {
            throw new EntityValidationException("Username already exists");
        }
        if (! $this->userRepository->checkEmailUnique($userData->getEmail(), $userData->getId())) {
            throw new EntityValidationException("Email already exists");
        }

        return $this->userRepository->update($userData);
    }
}
