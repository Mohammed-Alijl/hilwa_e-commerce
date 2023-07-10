<?php

namespace App\Http\Controllers;

use App\Http\Requests\City\IndexRequest;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(IndexRequest $request,$id){
        return $request->run($id);
    }
}
