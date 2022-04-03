<?php

namespace App\Http\Controllers;

use App\Actions\CreateGroup;
use App\Actions\DeleteGroup;
use App\Actions\FindGroup;
use App\Actions\ListGroups;
use App\Actions\UpdateGroup;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GroupController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Group::class);
        return GroupResource::collection(ListGroups::run());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGroupRequest $request
     * @return GroupResource
     * @throws AuthorizationException
     */
    public function store(StoreGroupRequest $request): GroupResource
    {
        $this->authorize('create', Group::class);
        return GroupResource::make(CreateGroup::run($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return GroupResource
     * @throws AuthorizationException
     */
    public function show(int $id): GroupResource
    {
        $this->authorize('view', Group::class);
        return GroupResource::make(FindGroup::run($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGroupRequest $request
     * @param int $id
     * @return GroupResource
     * @throws AuthorizationException
     */
    public function update(UpdateGroupRequest $request, int $id): GroupResource
    {
        $this->authorize('update', Group::class);
        return GroupResource::make(UpdateGroup::run($request->validated(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return GroupResource
     * @throws AuthorizationException
     */
    public function destroy(int $id): GroupResource
    {
        $this->authorize('delete', Group::class);
        return GroupResource::make(DeleteGroup::run($id));
    }
}
