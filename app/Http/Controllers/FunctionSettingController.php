<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaticSetting\StaticSetting;

class FunctionSettingController extends Controller
{
    public function staticSetting(StaticSetting $request)
    {
        return $request->run();
    }
}
