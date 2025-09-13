<?php

namespace Src\Users\Application;

use App\Models\User;
use Src\Shared\Domain\Exceptions\EntityNotFoundException;
use Src\Shared\Domain\Exceptions\UserIsNotAdminException;
use Src\Users\Domain\UserRepositoryInterface;

final class GetUserById
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) { }

    public function __invoke(User $user, int $id): \Src\Users\Domain\User {

        if (!$user->is_admin) {
            throw new UserIsNotAdminException();
        }

        $user = $this->userRepository->getByIdWithApplications($id);

        if (!$user) {
            throw new EntityNotFoundException();
        }

        return $user;
    }
}
