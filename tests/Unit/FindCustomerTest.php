<?php

use App\Actions\FindCustomer;
use App\Models\Customer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('deve encontrar cliente pelo uuid', function ($id) {
    $result = FindCustomer::run($id);
    expect($result)->not()->toBeNull();
})->with([
    fn() => Customer::factory()->createOne()->id
]);

test('deve lançar exceção caso usuário não seja encontrado', function () {
    FindCustomer::run(Uuid::uuid4());
})->throws(ModelNotFoundException::class, 'Cliente não encontrado');
