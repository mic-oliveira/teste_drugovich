<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;

class RemoveCustomerFromGroup
{
    use AsAction;

    public function handle(string $customer_id)
    {
        $customer = FindCustomer::run($customer_id);
        $customer->group_id = null;
        $customer->save();
        return $customer;
    }
}
