<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;

class DeleteGroup
{
    use AsAction;

    public function handle(int $id)
    {
        $group = FindGroup::run($id);
        $group->delete();
        return $group->refresh();
    }
}
