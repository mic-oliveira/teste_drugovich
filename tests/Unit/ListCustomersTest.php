<?php

use App\Actions\ListCustomers;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

dataset('clientes', [
    8,10,13
]);

test('deve retornar coleção de clientes.', function ($expectCount) {
    Customer::factory()->count($expectCount)->create();
    $result = ListCustomers::run();
    expect($result->count())->toBe($expectCount);
})->with('clientes');
