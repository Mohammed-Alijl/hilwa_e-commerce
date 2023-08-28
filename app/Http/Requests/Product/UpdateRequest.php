<?php

namespace App\Http\Requests\Product;

use App\Rules\DateRangeFormat;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $this->input('discount_type') ? $discountTypeCount = count($this->input('discount_type')) : $discountTypeCount = 0;
        return [
            'product_type'=>'required|in:complex,simple',
            'name_en'=>'required|string|max:255',
            'name_ar'=>'required|string|max:255',
            'description_en'=>'required|string',
            'description_ar'=>'required|string',
            'sku'=>'required|max:255',
            'weight_in_points'=>'required|numeric',
            'price'=>'required|numeric|gt:spacial_price',
            'spacial_price'=>'required|numeric',
            'min_quantity' => 'required|integer',
            'max_quantity' => 'required|integer|gt:min_quantity',
            'category_id'=>'required|integer|exists:categories,id',
            'unit_id'=>'required|integer|exists:units,id',
            'status'=>'required|boolean',
            'show_customer_app'=>'required|boolean',
            'stock_quantity'=>'required|integer|gt:max_quantity',
            'stock_status'=>'required|in:0,1,2,3',
            'discount_type'=>"array|size:$discountTypeCount",
            'discount_type.*'=>'in:fixed,percent',
            'discount_value'=>"array|size:$discountTypeCount",
            'discount_value.*'=>'numeric',
            'discount_date'=>"array|size:$discountTypeCount",
            'discount_date.*'=>[new DateRangeFormat()],
            'related_products'=>'array',
            'related_products.*'=>'numeric|exists:products,id',
            'featured_date'=>[new DateRangeFormat(),'required_with:display_order,featured_status'],
            'display_order'=>'required_with:featured_date,featured_status',
            'featured_status'=>'boolean|required_with:featured_date,display_order',
            'attribute_value_id'=>'array',
//            'attribute_value_id.*'=>'integer|exists:attribute_values,id',
            'images'=>'array',
            'images.*'=>'image|mimes:jpeg,png,jpg,svg|max:2048',
            'states'=>'array',
            'states.*'=>'numeric|exists:states,id',
            'cities'=>'array',
            'cities.*'=>'numeric|exists:cities,id',
        ];
    }
}
