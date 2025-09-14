<?php

namespace Src\Applications\Infrastructure;

use Illuminate\Http\Request;
use Src\Applications\Infrastructure\Eloquent\ApplicationModel;
use Symfony\Component\HttpFoundation\Response;

class CreateApplicationController
{

    public function __invoke(Request $request): Response
    {
        if (!$request->user()->is_admin) {
            return response()->json("Unauthorized", Response::HTTP_UNAUTHORIZED);
        }

        $input = $request->validate([
            'name' => 'required|string|max:80',
            'url' => 'required|url',
            'is_active' => 'required|bool'
        ]);

        $name = $input['name'];
        $url = $input['url'];

        // Verificar nombre y URL son unicos
        $exists = ApplicationModel::where(function ($query) use ($name, $url) {
            $query->where('name', $name)
                ->orWhere('url', $url);
        })->exists();

        if ($exists) {
            return response()->json("App already exists", Response::HTTP_CONFLICT);
        }

        $model = ApplicationModel::create([
            'name' => $input['name'],
            'url' => $input['url'],
            'is_active' => $input['is_active']
        ]);

        $app = [
            'id' => $model->id,
            'name' => $model->name,
            'url' => $model->url,
            'is_active' => $model->is_active,
        ];

        return response()->json($app, Response::HTTP_CREATED);
//        return response()->json(UserListResponse::fromArray($users));
    }

}
