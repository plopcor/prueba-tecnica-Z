<?php

namespace Src\Users\Infrastructure;

use Illuminate\Http\Request;
use Src\Shared\Domain\Exceptions\UserIsNotAdminException;
use Src\Users\Application\GetAllUsers;
use Src\Users\Domain\DTO\UserListResponse;
use Src\Users\Domain\DTO\UserResponse;
use Symfony\Component\HttpFoundation\Response;

class GetAllUsersController
{
    public function __invoke(Request $request): Response
    {

        try {

            $getUsers = app()->make(GetAllUsers::class);
            $users = $getUsers->__invoke($request->user());

        } catch (UserIsNotAdminException $e) {
            return response()->json("Unauthorized", 401);
        }


        return response()->json(UserResponse::fromArray($users));
//        return response()->json(UserListResponse::fromArray($users));
    }

}
