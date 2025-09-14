<?php

namespace Src\Users\Infrastructure\Eloquent;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Src\Users\Domain\User as User;
use App\Models\User as UserModel;
use Src\Users\Domain\UserRepositoryInterface;

final class EloquentUserRepository implements UserRepositoryInterface
{

    public function getAll(): array
    {
        return UserModel::with('applications:id')->get()
            ->map(fn($model) => $this->mapToEntity($model))
            ->toArray();
    }

    public function getById(int $id): ?User
    {
        $user = UserModel::find($id);
        if (!$user)
            return null;

        return $this->mapToEntity($user);
    }

    public function getByIdWithApplications(int $id): ?User
    {
        $user = UserModel::with('applications:id')->find($id);
        if (!$user)
            return null;

        return $this->mapToEntity($user);
    }

    public function create(User $user): User
    {
        $model = DB::transaction(function () use ($user) {
            $model = UserModel::create([
                'username' => $user->getUsername(),
                'name' => $user->getName(),
                'surname' => $user->getSurname(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'hire_date' => $user->getHireDate(),
                'department' => $user->getDepartment(),
                'position' => $user->getPosition(),
                'is_admin' => $user->isAdmin()
            ]);

            $model->applications()->sync($user->getApplicationIds() ?? []);
            return $model;
        });

        return $this->mapToEntity($model);
    }

    public function update(User $user): User
    {
        $model = DB::transaction(function () use ($user) {
            $model = UserModel::find($user->getId());
            if (! $model)
                return;

            $model->update([
                'email' => $user->getEmail(),
                'name' => $user->getName(),
                'surname' => $user->getSurname(),
                'hire_date' => $user->getHireDate(),
                'department' => $user->getDepartment(),
                'position' => $user->getPosition(),
                'is_admin' => $user->isAdmin()
            ]);

            $model->applications()->sync($user->getApplicationIds());
            return $model;
        });

        return $this->mapToEntity($model);
    }

    public function checkExists(int $id): bool
    {
        return UserModel::find($id)->exists();
    }

    public function checkUsernameUnique(string $username, int $ignoreId = null): bool
    {
        $query = UserModel::where(fn ($query) => $query->where('username', $username));
        if ($ignoreId)
            $query->where('id', '!=', $ignoreId);

        return ! $query->exists();
    }

    public function checkEmailUnique(string $email, int $ignoreId = null): bool
    {
        $query = UserModel::where(fn ($query) => $query->where('email', $email));
        if ($ignoreId)
            $query->where('id', '!=', $ignoreId);

        return ! $query->exists();
    }

    private function mapToEntity(UserModel $model): User
    {
        $applicationIds = $model->relationLoaded('applications')
            ? $model->applications->pluck('id')->all()
            : [];

        return new User(
            $model->id,
            $model->username,
            $model->name,
            $model->surname,
            $model->email,
            $model->hire_date,
            $model->department,
            $model->position,
            $model->is_admin,
            $applicationIds
        );
    }
}
