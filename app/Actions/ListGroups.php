<?php

namespace App\Actions;

use App\Models\Group;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Exceptions\InvalidFilterQuery;
use Spatie\QueryBuilder\QueryBuilder;

class ListGroups
{
    use AsAction;

    public function handle()
    {
        try{
            return QueryBuilder::for(Group::class)
                ->allowedFilters([
                    AllowedFilter::partial('name')
                ])
                ->simplePaginate();
        } catch (InvalidFilterQuery $exception) {
            throw new \Exception('Filtro inválido');
        }

    }
}
