<?php

namespace App\Actions;

use App\Models\Group;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateGroup
{
    use AsAction;

    public function handle(array $group)
    {
        if (empty($group['name'])) {
            throw new \Exception('Nome não pode ser nulo ou vazio');
        }
        $group = Group::create($group);
        return $group;
    }
}
