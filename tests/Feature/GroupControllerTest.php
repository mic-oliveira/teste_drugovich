<?php

use App\Models\Manager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('deve estar autenticado para acessar grupos', function () {
    actingAs(Manager::factory()->create());
    $response = $this->getJson('api/groups');
    $response->assertStatus(200);
});

test('deve bloquear acesso de pessoas não autenticadas', function () {
    $response = $this->getJson('api/groups');
    $response->assertStatus(401);
});

test('deve bloquear acesso de gerente autenticados com nível de acesso diferentes de 1 ou 2', function ($access_level) {
    actingAs(Manager::factory()->state(['access_level' => $access_level])->create());
    $response = $this->getJson('api/groups');
    $response->assertStatus(403);
})->with([
    0,3,4,5,6,7
]);

test('deve permitir criação grupos somente com gerente com nível de acesso 2', function () {
    actingAs(Manager::factory()->state(['access_level' => 2])->create());
    $response = $this->postJson('api/groups',['name' => 'Grupo Teste']);
    $response->assertStatus(201);
});

test('deve bloquear criação grupos somente com gerente com nível de acesso diferente de 2', function ($access_level) {
    actingAs(Manager::factory()->state(['access_level' => $access_level])->create());
    $response = $this->postJson('api/groups',['name' => 'Grupo Teste']);
    $response->assertStatus(403);
})->with([
    0,3,4,5,6,7
]);
