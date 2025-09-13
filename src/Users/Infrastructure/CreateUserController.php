<?php

namespace Src\Users\Infrastructure;

use Src\Shared\Domain\Exceptions\EntityValidationException;
use Src\Shared\Domain\Exceptions\UserIsNotAdminException;
use Src\Users\Application\CreateUser;
use Src\Users\Domain\DTO\UserResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController
{
    public function __invoke(Request $request, int $id): Response
    {
        $input = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'hire_date' => ['nullable', 'date', 'before_or_equal:today'],
            'department' => ['nullable', 'string', 'max:255'],
            'job_position' => ['nullable', 'string', 'max:255'],
        ]);

        try {

            $createUser = app()->make(CreateUser::class);
            $user = $createUser->__invoke($request->user(), $input);

        } catch (UserIsNotAdminException $e) {
            return response()->json(["message" => "Unauthorized"], Response::HTTP_UNAUTHORIZED);
        } catch (EntityValidationException $e) {
            return response()->json(["message" => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }

        return response()->json(new UserResponse($user));

    }

}
