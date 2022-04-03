<?php

use App\Actions\RemoveCustomerFromGroup;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

dataset('grupo dataset', [
    [fn() => Customer::factory()->hasGroup()->createOne()->id],
    [fn() => Customer::factory()->hasGroup()->createOne()->id]
]);
test('deve adicionar cliente em um grupo', function ($customer_id) {
    $result = RemoveCustomerFromGroup::run($customer_id);
    expect($result->id)->toBe($customer_id);
    expect($result->group_id)->toBeNull();
})->with('grupo dataset');
