<?php

use App\Actions\AuthenticateManager;
use App\Exceptions\WrongCredentialException;
use App\Models\Manager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    Manager::factory()->state(['email' => 'teste@teste.com', 'password' => Hash::make('teste')])->create();
});

test('deve autenticar usuario', function () {
    $result = AuthenticateManager::run('teste@teste.com','teste','teste');
    expect($result)->toHaveKey('token');
});

test('deve retornar exceção de login e senha incorreto', function () {
    AuthenticateManager::run('teste@teste.com','teste2','teste');
})->throws(WrongCredentialException::class, 'Email ou senha incorreto.');
