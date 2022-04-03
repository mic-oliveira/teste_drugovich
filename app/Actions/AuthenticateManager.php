<?php

namespace App\Actions;

use App\Exceptions\WrongCredentialException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class AuthenticateManager
{
    use AsAction;

    public function handle(string $email, string $password, string $userAgent)
    {
        $access = Auth::guard('api')->attempt(compact('email','password'));
        RevokeTokens::run();
        if ($access) {
            $token = Auth::guard('api')->user()->createToken($userAgent);
            return ['token' => $token->plainTextToken];
        }
        throw new WrongCredentialException('Email ou senha incorreto.', 401);
    }
}
