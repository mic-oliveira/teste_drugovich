<?php


use App\Actions\ListGroups;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

dataset('grupos', [
    7,2,15
]);

test('deve retornar coleção de clientes.', function ($expectCount) {
    Group::factory()->count($expectCount)->create();
    $result = ListGroups::run();
    expect($result->count())->toBe($expectCount);
})->with('grupos');
