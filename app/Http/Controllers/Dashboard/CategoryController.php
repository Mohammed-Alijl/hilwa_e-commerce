<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\AttributeRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\StateRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private CategoryRepository $categoryRepository,private AttributeRepository $attributeRepository, private StateRepository $stateRepository)
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
        $categories = $this->categoryRepository->getAll();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = $this->stateRepository->getAll();
        $categories = $this->categoryRepository->getAll();
        $attributes = $this->attributeRepository->getActiveCategoryAttributes();
        return view('dashboard.categories.create',compact('states','categories','attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
