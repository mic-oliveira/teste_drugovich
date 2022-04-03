<?php

use App\Actions\UpdateGroup;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
   Group::factory()->create();
});

test('deve atualizar nome do grupo', function ($group, $expectedName) {
    $result = UpdateGroup::run($group,1);
    expect($result->name)->toBe($expectedName);
})->with([
    [['name' => 'teste'], 'teste'],
    [['name' => 'marmota'], 'marmota'],
    [['name' => 'vermelho'], 'vermelho'],
]);
