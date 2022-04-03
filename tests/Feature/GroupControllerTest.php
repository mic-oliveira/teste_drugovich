<?php

use App\Models\Group;
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
    0,3,
]);

test('deve permitir criação grupos somente com gerente com nível de acesso 2', function () {
    actingAs(Manager::factory()->state(['access_level' => 2])->create());
    $response = $this->postJson('api/groups',['name' => 'Grupo Teste']);
    $response->assertStatus(201);
    $this->assertDatabaseHas('groups', ['name' => 'Grupo Teste']);
});

test('deve bloquear criação grupos somente com gerente com nível de acesso diferente de 2', function ($access_level) {
    actingAs(Manager::factory()->state(['access_level' => $access_level])->create());
    $response = $this->postJson('api/groups',['name' => 'Grupo Teste']);
    $response->assertStatus(403);
    $this->assertDatabaseCount('groups',0);
})->with([
    0,3
]);

test('deve permitir alteração em grupos apenas por gerente com nível de acesso 2', function () {
    actingAs(Manager::factory()->state(['access_level' => 2])->create());
    $response = $this->patchJson('api/groups/1',['name' => 'Grupo Teste Atualizado']);
    $response->assertStatus(200);
    $response->assertJsonFragment(['name' => 'Grupo Teste Atualizado']);
    $this->assertDatabaseHas('groups', ['name' => 'Grupo Teste Atualizado']);
})->with([
    fn() => Group::factory()->create()
]);

test('deve bloquear alteração em grupos por gerente com nível de acesso diferente de 2', function () {
    actingAs(Manager::factory()->state(['access_level' => 1])->create());
    $response = $this->patchJson('api/groups/1',['name' => 'Grupo Teste Atualizado']);
    $response->assertStatus(403);
});

test('deve permitir deletar grupos por um gerente com nível de acesso 2', function () {
    actingAs(Manager::factory()->state(['access_level' => 2])->create());
    $response = $this->deleteJson('api/groups/1');
    $response->assertStatus(200);
    $this->assertSoftDeleted('groups',['id' => 1]);
})->with([
    fn() => Group::factory()->create()
]);

test('deve bloquear deletar grupos por um gerente com nível de acesso diferente de 2', function () {
    actingAs(Manager::factory()->state(['access_level' => 1])->create());
    $response = $this->deleteJson('api/groups/1');
    $response->assertStatus(403);
})->with([
    fn() => Group::factory()->create()
]);

test('deve bloquear exibir grupo para gerentes com nível de acesso diferente de 1 e 2', function ($access_level) {
    actingAs(Manager::factory()->state(['access_level' => $access_level])->create());
    $response = $this->getJson('api/groups/1');
    $response->assertStatus(403);
})->with([
    0,3,4
])->with([
    fn() => Group::factory()->create()
]);

test('deve exibir grupo para gerentes com nível de acesso 1', function () {
    actingAs(Manager::factory()->state(['access_level' => 1])->create());
    $response = $this->getJson('api/groups/1');
    $response->assertStatus(200);
})->with([
    fn() => Group::factory()->create()
]);

test('deve exibir grupo para gerentes com nível de acesso 2', function () {
    actingAs(Manager::factory()->state(['access_level' => 2])->create());
    $response = $this->getJson('api/groups/1');
    $response->assertStatus(200);
})->with([
    fn() => Group::factory()->create()
]);

