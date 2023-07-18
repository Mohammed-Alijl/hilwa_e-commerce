<?php

namespace App\Http\Controllers;

use App\Http\Requests\City\IndexRequest;
use App\Http\Requests\City\StoreRequest;
use App\Http\Requests\City\UpdateRequest;
use Illuminate\Http\Request;

class CityController extends Controller
{
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
