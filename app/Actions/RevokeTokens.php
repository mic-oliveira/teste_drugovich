<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class RevokeTokens
{
    use AsAction;

    public function handle(): bool
    {
        if (env('MULTIPLE_ACCESS')) {
            return false;
        }
        $user = Auth::guard('api')->user();
        $user?->tokens()->delete();
        return true;
    }
}
