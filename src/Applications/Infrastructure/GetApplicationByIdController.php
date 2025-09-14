<?php

namespace Src\Applications\Infrastructure;

use Illuminate\Http\Request;
use Src\Applications\Infrastructure\Eloquent\ApplicationModel;
use Symfony\Component\HttpFoundation\Response;

class GetApplicationByIdController
{

    // If "isAdmin", show all
    // If not, show only assigned applications

    public function __invoke(Request $request, int $id): Response
    {
        if (!$request->user()->is_admin) {
            return response()->json("Unauthorized", Response::HTTP_UNAUTHORIZED);
        }

        $model = ApplicationModel::find($id);

        if (! $model) {
            return response()->json("Not found", Response::HTTP_NOT_FOUND);
        }

        $app = [
            'id' => $model->id,
            'name' => $model->name,
            'url' => $model->url,
            'is_active' => $model->is_active,
        ];

        return response()->json($app);
//        return response()->json(UserListResponse::fromArray($users));
    }
}
