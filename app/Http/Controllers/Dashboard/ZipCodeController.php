<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\ZipCode\StoreRequest;
use App\Models\ZipCode;

class ZipCodeController extends Controller
{
    public function store(StoreRequest $request)
    {
        $zipCode = new ZipCode();
        $zipCode->zip_code = $request->input('zip_code');
        $zipCode->save();

        return response()->json(['zip_code' => $zipCode->zip_code]);
    }
}
