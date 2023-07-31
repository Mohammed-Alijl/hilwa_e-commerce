<?php

namespace App\Http\Requests\User;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function run(){
        $users = Admin::orderBy('id','DESC')->get();
        $rowNumber = 1;
        return view('Front-end.admins.index',compact('users','rowNumber'))
            ->with('i', ($this->input('page', 1) - 1) * 5);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
