<?php

namespace App\Http\Controllers;

use App\Actions\AuthenticateManager;
use App\Http\Requests\AuthenticationRequest;

class AuthController extends Controller
{
    public function authenticate(AuthenticationRequest $request)
    {
        return AuthenticateManager::run($request->get('email'), $request->get('password'), $request->userAgent());
    }
}
