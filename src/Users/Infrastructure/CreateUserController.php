<?php

namespace Src\Users\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Src\Shared\Domain\Exceptions\EntityValidationException;
use Src\Shared\Domain\Exceptions\UserIsNotAdminException;
use Src\Users\Application\CreateUser;
use Src\Users\Domain\DTO\UserResponse;
use Src\Users\Domain\User;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController
{
    public function __invoke(Request $request): Response
    {
        $input = $request->validate([
            'username' => ['required', 'string'],
            'email' => ['required', 'email',],
            'name' => ['required', 'string'],
            'surname' => ['nullable', 'string'],
            'password' => ['required', 'string'],
            'hire_date' => ['nullable', 'date', 'before_or_equal:today'],
            'department' => ['nullable', 'string'],
            'position' => ['nullable', 'string'],
            'applications' => ['nullable', 'array'],
            'is_admin' => ['nullable', 'boolean']
        ]);

        $user = User::createWithPassword(
            null,
            $input['username'],
            $input['name'],
            $input['surname'] ?? null,
            $input['email'],
            Hash::make($input['password']),
            $input['hire_date'] ?? null,
            $input['department'] ?? null,
            $input['position'] ?? null,
            $input['is_admin'] ?? false,
            array_values($input['applications'] ?? []),
        );

        try {

            $createUser = app()->make(CreateUser::class);
            $user = $createUser->__invoke($request->user(), $user);

        } catch (UserIsNotAdminException $e) {
            return response()->json(["message" => "Unauthorized"], Response::HTTP_UNAUTHORIZED);
        } catch (EntityValidationException $e) {
            return response()->json(["message" => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }

        return response()->json(new UserResponse($user));

    }

}
