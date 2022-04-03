<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;

class AddCustomerToGroup
{
    use AsAction;

    public function handle(string $customer_id, int $group_id)
    {
        $customer = FindCustomer::run($customer_id);
        $customer->group_id = FindGroup::run($group_id)->id;
        $customer->save();
        return $customer->refresh();
    }
}
