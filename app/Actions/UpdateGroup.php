<?php

namespace App\Actions;

use App\Models\Group;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateGroup
{
    use AsAction;

    public function handle(array $group, int $id)
    {
        $group = FindGroup::run($id)->fill($group);
        $group->save();
        return $group;
    }
}
