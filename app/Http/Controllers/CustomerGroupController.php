<?php

namespace App\Http\Controllers;

use App\Actions\AddCustomerToGroup;
use App\Actions\RemoveCustomerFromGroup;
use App\Http\Requests\CustomerGroupRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class CustomerGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomerGroupRequest $request
     * @return CustomerResource
     * @throws AuthorizationException
     */
    public function store(CustomerGroupRequest $request): CustomerResource
    {
        $this->authorize('add-group', Customer::class);
        return CustomerResource::make(
            AddCustomerToGroup::run($request->validated('customer_id'), $request->validated('group_id'))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return CustomerResource
     * @throws AuthorizationException
     */
    public function destroy(int $id): CustomerResource
    {
        $this->authorize('remove-group', Customer::class);
        return CustomerResource::make(RemoveCustomerFromGroup::run($id));
    }
}
