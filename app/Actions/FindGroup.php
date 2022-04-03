<?php

namespace App\Actions;

use App\Models\Group;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class FindGroup
{
    use AsAction;

    public function handle(int $id)
    {
        try{
            return Group::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException('Grupo não encontrado.');
        }

    }
}
