<?php

namespace App\Actions;

use App\Models\Customer;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ListCustomers
{
    use AsAction;

    public function handle()
    {
        return QueryBuilder::for(Customer::class)
            ->allowedFilters([
                AllowedFilter::partial('name'),
                AllowedFilter::exact('group_id')
            ])
            ->simplePaginate();
    }
}
