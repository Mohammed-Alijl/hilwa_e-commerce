<?php

namespace App\Http\Controllers;

use App\Http\Requests\City\IndexRequest;
use App\Http\Requests\City\StoreRequest;
use App\Http\Requests\City\UpdateRequest;
use Illuminate\Http\Request;

class CityController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view_city', ['only' => ['index','show']]);
        $this->middleware('permission:add_city', ['only' => ['create','store']]);
        $this->middleware('permission:edit_city', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_city', ['only' => ['destroy']]);
    }
    public function index(IndexRequest $request){
        return $request->run();
    }

    public function store(StoreRequest $request){
        return $request->run();
    }

    public function update(UpdateRequest $request){
        return $request->run();
    }
}
