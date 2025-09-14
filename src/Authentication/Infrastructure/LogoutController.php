<?php

namespace Src\Authentication\Infrastructure;

class LogoutController
{
    public function __invoke()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // Web session only
        auth()->guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        // API token only
        // $user->currentAccessToken()->delete();

        return response()->noContent(); // HTTP 204
    }
}
