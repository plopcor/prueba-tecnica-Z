<?php

namespace Src\Users\Infrastructure;

use Src\Shared\Domain\Exceptions\EntityNotFoundException;
use Src\Shared\Domain\Exceptions\UserIsNotAdminException;
use Src\Users\Application\GetUserById;
use Src\Users\Domain\DTO\UserResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GetUserByIdController
{

    public function __invoke(Request $request, int $id): Response
    {
        try {

            $getUser = app()->make(GetUserById::class);
            $user = $getUser->__invoke($request->user(), $id);

        } catch (UserIsNotAdminException $e) {
            return response()->json(["message" => "Unauthorized"], Response::HTTP_UNAUTHORIZED);
        } catch (EntityNotFoundException $e) {
            return response()->json(["message" => "User not found"], Response::HTTP_NOT_FOUND);
        }

        return response()->json(new UserResponse($user));

    }

}
