<?php

namespace Src\Applications\Infrastructure;

use Illuminate\Http\Request;
use Src\Applications\Domain\DTO\ApplicationResponse;
use Src\Applications\Infrastructure\Eloquent\ApplicationModel;
use Symfony\Component\HttpFoundation\Response;

class GetAllApplicationsController
{

    // If "isAdmin", show all
    // If not, show only assigned applications

    public function __invoke(Request $request): Response
    {
        if (!$request->user()->is_admin) {
            return response()->json("Unauthorized", 401);
        }

        $apps = ApplicationModel::all()
            ->map(fn($model) => [
                'id' => $model->id,
                'name' => $model->name,
                'url' => $model->url,
                'is_active' => $model->is_active,
            ])
            ->toArray();

        return response()->json($apps);
//        return response()->json(ApplicationResponse::fromArray($apps));
    }
}
