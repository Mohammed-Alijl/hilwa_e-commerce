<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Traits\AttachmentTrait;

class CategoryRepository implements BasicRepositoryInterface
{
    use AttachmentTrait;
    public function getAll()
    {
        return Category::get();
    }

    public function find($id)
    {
        return Category::findOrFail($id);
    }

    public function create($request)
    {
        $category = new Category();
        $category->display_order = $request->display_order;
        $category->color_code = $request->color_code;
        $category->status = $request->status;
        $imageName = $this->save_attachment($request->file('image'),'img/categories');
        $category->image = $imageName;
        if($request->filled('parent_category_id'))
            $category->parent_category_id = $request->parent_category_id;
        $category->save();
        $categoryTranslation = new CategoryTranslation();
        $categoryTranslation->name = $request->name;
        $categoryTranslation->language_id = 1;
        $categoryTranslation->category_id = $category->id;
        $categoryTranslation->save();
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getParentsCategories(){
        return Category::where('parent_category_id',null)->get();
    }

}
