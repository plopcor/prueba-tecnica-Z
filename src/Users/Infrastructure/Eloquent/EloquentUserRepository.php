<?php

namespace Src\Users\Infrastructure\Eloquent;

use Src\Users\Domain\User as User;
use App\Models\User as UserModel;
use Src\Users\Domain\UserRepositoryInterface;

final class EloquentUserRepository implements UserRepositoryInterface
{

    public function getAll(): array
    {
        return UserModel::all()
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

    public function create(): User
    {
//        UserModel::create
    }

    public function update(User $user): User
    {
        DB::transaction(function () use ($user) {
            $user = UserModel::find($user->getId())->update([

            ]);
        });
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
