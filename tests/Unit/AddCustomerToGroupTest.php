<?php

use App\Actions\AddCustomerToGroup;
use App\Models\Customer;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

dataset('group dataset', [
    [fn() => Customer::factory()->createOne()->id, 1],
    [fn() => Customer::factory()->createOne()->id, 2]
]);
test('deve adicionar cliente em um grupo', function (int $customer_id, int $group_id) {
    Group::factory()->count(2)->create();
    $result = AddCustomerToGroup::run($customer_id, $group_id);
    expect($result->id)->toBe($customer_id);
    expect((int)$result->group_id)->toBe($group_id);
})->with('group dataset');

