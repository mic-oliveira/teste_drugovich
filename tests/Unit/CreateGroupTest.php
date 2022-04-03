<?php

use App\Actions\CreateGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);


test('deve criar novo grupo', function ($group, $expectedName) {
    $result = CreateGroup::run($group);
    expect($result->name)->toBe($expectedName);
})->with([
    [['name' => 'teste'], 'teste'],
    [['name' => 'marmota'], 'marmota'],
    [['name' => 'vermelho'], 'vermelho'],
]);

test('deve lançar exceção ao criar grupo com nome vazio ou nulo', function ($group) {
    CreateGroup::run($group);
})->with([
    [['name' => null]],
    [['name' => '']]
])->throws(Exception::class, 'Nome não pode ser nulo ou vazio');
