<?php

namespace App\Http\Requests\City;

use App\Models\Zone;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function run($id){
        $zone = Zone::find($id);
        $cities = $zone->cities->pluck('name','id');
        return json_encode($cities);
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
