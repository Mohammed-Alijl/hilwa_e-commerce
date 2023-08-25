<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Product;
use App\Models\ProductDiscount;
use App\Models\ProductFeatured;
use App\Models\ProductImage;
use App\Traits\AttachmentTrait;
use Illuminate\Support\Facades\DB;

class ProductRepository implements BasicRepositoryInterface
{
    use AttachmentTrait;

    public function getAll()
    {
        return Product::get();
    }

    public function find($id)
    {
        return Product::findOrFail($id);
    }

    public function create($request)
    {
        //create the product
        $product = new Product();
        $product->setTranslation('name', 'en', $request->name_en);
        $product->setTranslation('name', 'ar', $request->name_ar);
        $product->description_en = $request->description_en;
        $product->description_ar = $request->description_ar;
        $product->sku = $request->sku;
        $product->weight_in_points = $request->weight_in_points;
        $product->price = $request->price;
        $product->special_price = $request->spacial_price;
        $product->min_quantity = $request->min_quantity;
        $product->max_quantity = $request->max_quantity;
        $product->category_id = $request->category_id;
        $product->unit_id = $request->unit_id;
        $product->status = $request->status;
        $product->show_customer_app = $request->show_customer_app;
        $product->stock_quantity = $request->stock_quantity;
        $product->stock_status = $request->stock_status;
        $product->save();


        //create the product images
        foreach ($request->images as $image) {
            $imageName = $this->save_attachment($image, 'img/products/');
            $productImage = new ProductImage();
            $productImage->product_id = $product->id;
            $productImage->name = $imageName;
            $productImage->save();
        }

        //create the discount
        if($request->filled('discount_type')){
            for($i=0;$i<count($request->discount_type);$i++){
                $productDiscount = new ProductDiscount();
                $productDiscount->product_id = $product->id;
                $productDiscount->discount_type = $request->discount_type[$i];
                $productDiscount->discount_value = $request->discount_value[$i];
                $discountDateRange = explode(' to ', $request->discount_date[$i]);
                $discountStartDate = strtotime(trim($discountDateRange[0]));
                $discountEndDate = strtotime(trim($discountDateRange[1]));
                $productDiscount->start_date = date('Y-m-d', $discountStartDate);
                $productDiscount->end_date = date('Y-m-d', $discountEndDate);
                $productDiscount->save();
            }
        }


        //create the restricted in cities
        $product->cities()->attach($request->cities);


        //create product featured
        if ($request->filled('featured_date')) {
            $productFeatured = new ProductFeatured();
            $productFeatured->product_id = $product->id;
            $productFeatured->display_order = $request->display_order;
            $productFeatured->status = $request->featured_status;
            $featuredDateRange = explode('to', $request->featured_date);
            $featuredStartDate = strtotime(trim($featuredDateRange[0]));
            $featuredEndDate = strtotime(trim($featuredDateRange[1]));
            $productFeatured->start_at = date('Y-m-d',$featuredStartDate);
            $productFeatured->end_at = date('Y-m-d',$featuredEndDate);
            $productFeatured->save();
        }


        //create related products
        if ($request->filled('related_products')) {
            $relatedProducts = $request->input('related_products', []);

            $relatedPairs = [];
            foreach ($relatedProducts as $relatedProduct) {
                $relatedPairs[] = [
                    'product_id' => $product->id,
                    'related_product_id' => $relatedProduct,
                ];
            }
            DB::table('related_products')->insert($relatedPairs);
        }


        if ($request->product_type === 'complex') {
            //create attribute products
            if ($request->filled('attribute_id'))
                $product->attributes()->attach($request->attribute_id);
            //create options attribute products
            if($request->filled('attribute_value_id'))
                $product->options()->attach($request->attribute_value_id);

        }

    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        foreach ($product->images as $image){
            $this->delete_attachment("img/products/$image->name");
            $image->delete();
        }
        $product->relatedProducts()->detach();
        $product->cities()->detach();
        ProductFeatured::where('product_id',$product->id)->delete();
        $product->attributes()->detach();
        $product->options()->detach();
        $product->delete();
    }

    public function getActiveProducts()
    {
        return Product::where('status', 1)->get();
    }
}
