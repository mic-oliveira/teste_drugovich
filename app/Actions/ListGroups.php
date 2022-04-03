<?php

namespace App\Actions;

use App\Models\Group;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ListGroups
{
    use AsAction;

    public function handle()
    {
        return QueryBuilder::for(Group::class)
            ->allowedFilters([
                AllowedFilter::partial('name')
            ])
            ->simplePaginate();
    }
}
