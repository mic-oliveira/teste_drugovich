<?php

use App\Models\Customer;
use App\Models\Group;
use App\Models\Manager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('deve estar autenticado acessar', function () {
    $response = $this->postJson('api/customer_groups',['customer_id' => 1, 'group_id' => 1]);
    $response->assertStatus(401);
});

test('deve adicionar cliente ao grupo se gerente estiver com nível de acesso entre 1 e 2', function () {
    actingAs(Manager::factory()->state(['access_level' => 1])->create());
    $response = $this->postJson('api/customer_groups',['customer_id' => 1, 'group_id' => 1]);
    $response->assertStatus(200);
    $this->assertDatabaseHas('customers', ['id' => 1, 'group_id' => 1]);
})->with([
    fn() => Customer::factory()->create()
])->with([
    fn() => Group::factory()->create()
]);

test('deve bloquear adicionar cliente ao grupo se gerente estiver com nível de acesso diferentes de 1 e 2', function ($access_level) {
    actingAs(Manager::factory()->state(['access_level' => $access_level])->create());
    $response = $this->postJson('api/customer_groups',['customer_id' => 1, 'group_id' => 1]);
    $response->assertStatus(403);
})->with([
    0,3,4,99
])->with([
    fn() => Customer::factory()->create()
])->with([
    fn() => Group::factory()->create()
]);

test('deve remover cliente do grupo se gerente estiver com nível de acesso entre 1 e 2', function ($access_level) {
    Customer::factory()->hasGroup()->create();
    actingAs(Manager::factory()->state(['access_level' => $access_level])->create());
    $response = $this->deleteJson('api/customer_groups/1');
    $response->assertStatus(200);
    $this->assertDatabaseHas('customers', ['id' => 1, 'group_id' => null]);
})->with([
    1,2
]);

test('deve bloquear remover cliente do grupo se gerente estiver com nível de acesso diferentes 1 e 2', function ($access_level) {
    Customer::factory()->hasGroup()->create();
    actingAs(Manager::factory()->state(['access_level' => $access_level])->create());
    $response = $this->deleteJson('api/customer_groups/1');
    $response->assertStatus(403);
    $this->assertDatabaseHas('customers', ['id' => 1, 'group_id' => null]);
})->with([
    0,3,99
]);


