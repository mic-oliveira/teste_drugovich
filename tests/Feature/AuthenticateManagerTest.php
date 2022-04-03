<?php

use App\Models\Manager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses( RefreshDatabase::class);

beforeEach(function() {
    Manager::factory()->state(['email' => 'admin@admin.com', 'password' => Hash::make('admin')])->create();
});

test('deve autenticar gerente', function () {
    $response = $this->postJson('/api/auth', ['email' => 'admin@admin.com', 'password' => 'admin']);
    $response->assertStatus(200);
    $response->assertJsonStructure(['token']);
});

test('deve lançar exceção de login e senha incorreto', function() {
    $response = $this->postJson('/api/auth', ['email' => 'admin@admin.com', 'password' => 'admin2']);
    $response->assertStatus(401);
    $response->assertExactJson(['message' => 'Email ou senha incorreto.']);
});
