<?php

namespace App\Actions;

use App\Models\Customer;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Exceptions\InvalidFilterQuery;
use Spatie\QueryBuilder\Exceptions\InvalidFilterValue;
use Spatie\QueryBuilder\QueryBuilder;

class ListCustomers
{
    use AsAction;

    public function handle()
    {
        try{
            return QueryBuilder::for(Customer::class)
                ->allowedIncludes('group')
                ->allowedFilters([
                    AllowedFilter::partial('name'),
                    AllowedFilter::exact('group_id'),
                    AllowedFilter::partial('group_name','group.name')
                ])
                ->simplePaginate();
        } catch (InvalidFilterQuery $exception) {
            throw new \Exception('Filtro inválido');
        }

    }
}
