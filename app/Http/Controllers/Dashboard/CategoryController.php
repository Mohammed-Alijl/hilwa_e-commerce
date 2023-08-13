<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\LanguageRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private CategoryRepository $categoryRepository,private LanguageRepository $languageRepository)
    {
        $this->middleware('permission:view_category', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_category', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_category', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_category', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryRepository->getParentsCategories();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryRepository->getActiveCategories();
        return view('dashboard.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryRepository->create($request);
        if ($request->filled('parent_category_id'))
            return redirect()->route('categories.show', $request->parent_category_id)->with('add-success', __('success_messages.category.add.success'));
        else
            return redirect()->route('categories.index')->with('add-success', __('success_messages.category.add.success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = $this->categoryRepository->getChildCategories($id);
        return view('dashboard.categories.show', compact('categories','id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->categoryRepository->find($id);
        $categories = $this->categoryRepository->getActiveCategories();
        $languages = $this->languageRepository->getAll();
        return view('dashboard.categories.edit',compact('category','languages','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->categoryRepository->update($request,$id);
        return redirect()->route('categories.index')->with('edit-success',__('success_messages.category.edit.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = $this->categoryRepository->find($id);
        if ($this->categoryRepository->getChildCategories($category->id)->count() > 0) {
            return redirect()->route('categories.index')->with('delete-failed', __('failed_messages.category.delete.failed'));
        } else {
            $this->categoryRepository->delete($id);
            return redirect()->route('categories.index')->with('delete-success',__('success_messages.category.delete.success'));
        }
    }

    public function createChild($id)
    {
        return view('dashboard.categories.create_child_category', compact('id'));
    }

    public function getCategoryLanguages($langId, $categoryId)
    {
        $storeTranslation = $this->categoryRepository->getCategoryLanguages($langId, $categoryId);

        if (!$storeTranslation) {
            return json_decode('');
        }
        return response()->json(['category_name' => $storeTranslation->name]);
    }


}
