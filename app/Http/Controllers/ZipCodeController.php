<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZipCode\StoreRequest;
use App\Models\ZipCode;
use Illuminate\Http\Request;

class ZipCodeController extends Controller
{
    public function store(StoreRequest $request){
        return $request->run();
    }
}
