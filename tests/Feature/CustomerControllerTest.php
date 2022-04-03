<?php

use App\Models\Customer;
use App\Models\Manager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('deve estar autenticado para acessar clientes', function () {
    actingAs(Manager::factory()->create());
    $response = $this->getJson('api/customers');
    $response->assertStatus(200);
});

test('deve bloquear acesso de gerentes não autenticadas', function () {
    $response = $this->getJson('api/groups');
    $response->assertStatus(401);
});

test('deve permitir listagem de clientes para gerente autenticados com nível de acesso diferentes de 1 ou 2', function ($access_level) {
    actingAs(Manager::factory()->state(['access_level' => $access_level])->create());
    $response = $this->getJson('api/customers');
    $response->assertStatus(403);
})->with([
    0,3,
]);

test('deve permitir listagem de clientes para gerentes autenticados com nível de acesso entre 1 e 2', function ($access_level) {
    actingAs(Manager::factory()->state(['access_level' => $access_level])->create());
    $response = $this->getJson('api/customers');
    $response->assertStatus(200);
})->with([
    1,2,
]);

test('deve bloquear visualização de gerente autenticados com nível de acesso diferentes de 1 ou 2', function ($access_level) {
    actingAs(Manager::factory()->state(['access_level' => $access_level])->create());
    $response = $this->getJson('api/customers/1');
    $response->assertStatus(403);
})->with([
    0,3,
]);

test('deve permitir visualização de gerentes autenticados com nível de acesso entre 1 e 2', function ($access_level) {
    actingAs(Manager::factory()->state(['access_level' => $access_level])->create());
    $response = $this->getJson('api/customers/1');
    $response->assertStatus(200);
})->with([
    1,2,
])->with([
    fn() => Customer::factory()->create()
]);

test('deve retornar 404 para clientes não encontrados', function () {
    actingAs(Manager::factory()->state(['access_level' => 1])->create());
    $response = $this->getJson('api/customers/1');
    $response->assertStatus(404);
});

test('deve retornar status 422 em caso de falha de validação', function () {
    actingAs(Manager::factory()->state(['access_level' => 1])->create());
    $response = $this->postJson('api/customer_groups', ["customer_id" => null, "group_id" => null]);
    $response->assertStatus(422);
});

