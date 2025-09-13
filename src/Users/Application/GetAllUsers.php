<?php

namespace Src\Users\Application;

use App\Models\User;
use Src\Shared\Domain\Exceptions\UserIsNotAdminException;
use Src\Users\Domain\UserRepositoryInterface;

final class GetAllUsers
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) { }

    public function __invoke(User $user): array {

        if (!$user->is_admin) {
            throw new UserIsNotAdminException();
        }

        return $this->userRepository->getAll();
    }
}
