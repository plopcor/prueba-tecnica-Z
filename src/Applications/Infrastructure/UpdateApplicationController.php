<?php

namespace Src\Applications\Infrastructure;

use Illuminate\Http\Request;
use Src\Applications\Domain\DTO\ApplicationResponse;
use Src\Applications\Infrastructure\Eloquent\ApplicationModel;
use Symfony\Component\HttpFoundation\Response;

class UpdateApplicationController
{
    public function __invoke(Request $request, int $id): Response
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

        $exists = ApplicationModel::find($id)->exists();
        if (! $exists) {
            return response()->json("App does not exist", Response::HTTP_NOT_FOUND);
        }

        // Verificar nombre y URL son unicos
        $exists = ApplicationModel::where('id', '!=', $id)
            ->where(function ($query) use ($name, $url) {
                $query->where('name', $name)
                    ->orWhere('url', $url);
        })->exists();

        if ($exists) {
            return response()->json("App already exists", Response::HTTP_CONFLICT);
        }

        $rows = ApplicationModel::where('id', $id)->update($input);

        $model = ApplicationModel::find($id);

        return response()->json(new ApplicationResponse($model), Response::HTTP_CREATED);
    }
}
