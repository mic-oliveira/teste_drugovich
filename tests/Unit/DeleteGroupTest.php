<?php

use App\Actions\DeleteGroup;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    Group::factory()->create();
});

test('deve deletar grupo', function () {
    $result = DeleteGroup::run(1);
    expect($result)->not->toBeNull();
});
