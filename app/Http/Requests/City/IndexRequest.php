<?php

namespace App\Http\Requests\City;

use App\Models\City;
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


    public function run(){
        $cities = City::get();
        $states = State::get();
        $rowNumber = 1;
        return view('Front-end.cities.index',compact('cities','rowNumber','states'));
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
