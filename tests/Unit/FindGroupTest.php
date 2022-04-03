<?php

use App\Actions\FindGroup;
use App\Models\Group;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('Deve encontrar grupo pelo id', function ($id) {
    $result = FindGroup::run($id);
    expect($result)->not()->toBeNull();
})->with([
    fn() => Group::factory()->createOne()->id
]);

test('Deve lançar exceção caso grupo não seja encontrado', function () {
    FindGroup::run(1);
})->throws(ModelNotFoundException::class, 'Grupo não encontrado');
