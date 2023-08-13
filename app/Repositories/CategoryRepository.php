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
        $imageName = $this->save_attachment($request->file('image'), 'img/categories');
        $category->image = $imageName;
        if ($request->filled('parent_category_id'))
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
        $category = Category::findOrFail($id);
        $category->display_order = $request->display_order;
        $category->color_code = $request->color_code;
        $category->status = $request->status;
        if ($files = $request->file('image')) {
            $this->delete_attachment('img/categories/' . $category->image);
            $imageName = $this->save_attachment($files, 'img/categories');
            $category->image = $imageName;
        }
        if ($request->filled('parent_category_id'))
            $category->parent_category_id = $request->parent_category_id;
        $category->save();
        $categoryTranslation = new CategoryTranslation();
        $categoryTranslation->name = $request->name;
        $categoryTranslation->language_id = $request->language_id;
        $categoryTranslation->category_id = $category->id;
        $categoryTranslation->save();
        if(!$request->status){
            $this->updateNestedCategoriesStatus($category, $request->status);
        }
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        // prevent delete if the category has products
        $this->delete_attachment('img/categories/' . $category->image);
        $category->delete();
    }

    public function getParentsCategories()
    {
        return Category::where('parent_category_id', null)->get();
    }

    public function getChildCategories($id)
    {
        return Category::where('parent_category_id', $id)->get();
    }

    public function getCategoryLanguages($langId, $categoryId)
    {
        return CategoryTranslation::where('category_id', $categoryId)
            ->where('language_id', $langId)
            ->first();
    }

    public function getActiveCategories()
    {
        return Category::where('status', 1)->get();
    }


    public function updateNestedCategoriesStatus($category, $status)
    {
        $category->status = $status;
        $category->save();

        $childCategories = $this->getChildCategories($category->id);

        foreach ($childCategories as $childCategory) {
            $this->updateNestedCategoriesStatus($childCategory, $status);
        }
    }

}
