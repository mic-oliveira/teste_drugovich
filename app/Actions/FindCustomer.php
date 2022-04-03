<?php

namespace App\Actions;

use App\Models\Customer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lorisleiva\Actions\Concerns\AsAction;

class FindCustomer
{
    use AsAction;

    public function handle(string $id)
    {
        try {
            return Customer::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException('Cliente não encontrado');
        }
    }
}
