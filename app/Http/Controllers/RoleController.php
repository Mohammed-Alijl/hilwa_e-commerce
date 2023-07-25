<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\CreateRequest;
use App\Http\Requests\Role\DestroyRequest;
use App\Http\Requests\Role\EditRequest;
use App\Http\Requests\Role\IndexRequest;
use App\Http\Requests\Role\ShowRequest;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:view_role', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_role', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_role', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_role', ['only' => ['destroy']]);
    }

    protected $methods = ['view', 'add', 'edit', 'delete'];
    protected $models = ['dashboard', 'order', 'customer', 'driver', 'contact-request', 'review', 'category', 'product',
        'attribute', 'return', 'comment', 'advertisement', 'marketing', 'coupon', 'unit', 'store', 'setting', 'timeslot', 'user',
        'role', 'city','zone', 'log', 'reward', 'cms-page', 'holiday', 'chat', 'order-status', 'pre-sales-customer', 'payment-services'];

    public function getMethods()
    {
        return $this->methods;
    }

    public function getModels()
    {
        return $this->models;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        return $request->run();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateRequest $request)
    {
        return $request->run($this->getMethods(), $this->getModels());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        return $request->run();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowRequest $request, $id)
    {
        return $request->run($id, $this->getMethods(), $this->getModels());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EditRequest $request, $id)
    {
        return $request->run($id, $this->getMethods(), $this->getModels());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        return $request->run($id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyRequest $request)
    {
        return $request->run();
    }
}
