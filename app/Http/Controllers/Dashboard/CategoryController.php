<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private CategoryRepository $categoryRepository)
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
        $categories = $this->categoryRepository->getAll();
        return view('dashboard.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryRepository->create($request);
        if ($request->parent_category_id != null)
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function createChild($id)
    {
        return view('dashboard.categories.create_child_category', compact('id'));
    }
}
