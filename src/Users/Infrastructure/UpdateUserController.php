<?php

namespace Src\Users\Infrastructure;

use App\Models\User as UserModel;
use Illuminate\Http\Request;
use Src\Shared\Domain\Exceptions\EntityValidationException;
use Src\Shared\Domain\Exceptions\UserIsNotAdminException;
use Src\Users\Application\UpdateUser;
use Src\Users\Domain\DTO\UserResponse;
use Src\Users\Domain\User as User;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserController
{
    public function __invoke(Request $request, int $id): Response
    {
        if (!$request->user()->is_admin) {
            return response()->json("Unauthorized", Response::HTTP_UNAUTHORIZED);
        }

        $input = $request->validate([
//            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
//            'password' => ['required', 'string', 'min:8'],
            'hire_date' => ['nullable', 'date', 'before_or_equal:today'],
            'department' => ['nullable', 'string', 'max:255'],
            'job_position' => ['nullable', 'string', 'max:255'],
            'applications' => ['nullable', 'array']
        ]);

        // IMPROVEMENT: Usar DTO especifico para actualizar
        $user = new User(
            $id,
            "",
            $input['name'],
            $input['surname'] ?? null,
            $input['email'],
            $input['hire_date'] ?? null,
            $input['department'] ?? null,
            $input['position'] ?? null,
            $input['is_admin'] ?? false,
            array_values($input['applications'] ?? []),
        );

        try {

            $updateUser = app()->make(UpdateUser::class);
            $user = $updateUser->__invoke($request->user(), $user);

        } catch (UserIsNotAdminException $e) {
            return response()->json(["message" => "Unauthorized"], Response::HTTP_UNAUTHORIZED);
        } catch (EntityValidationException $e) {
            return response()->json(["message" => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }

        return response()->json(new UserResponse($user), Response::HTTP_CREATED);




        $exists = UserModel::find($id)->exists();
        if (! $exists) {
            return response()->json("User does not exist", Response::HTTP_NOT_FOUND);
        }

        $email = $input['email'];

        // Email unico
        $exists = UserModel::where('id', '!=', $id)
            ->where(function ($query) use ($email) {
                $query->where('email', $email);
            })->exists();

        if ($exists) {
            return response()->json("Email already exists", Response::HTTP_CONFLICT);
        }

        $model = UserModel::find($id);
        $model->update($input); // Actualizar datos
        $model->applications()->sync($input['applications'] ?? []);   // Actualizar relacion

        $user = new User(
            $model->id,
            $model->username,
            $model->name,
            $model->surname,
            $model->email,
            $model->hire_date,
            $model->department,
            $model->position,
            $model->is_admin,
            $input['applications'] ?? []
        );

        return response()->json(new UserResponse($user), Response::HTTP_CREATED);
//        return response()->json(new UserResponse($model), Response::HTTP_CREATED);
    }

}
