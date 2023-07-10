<?php

namespace App\Http\Requests\City;

use App\Models\State;
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
        $state = State::find($id);
        $cities = $state->cities->pluck('name','id');
        return json_encode($cities);
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
