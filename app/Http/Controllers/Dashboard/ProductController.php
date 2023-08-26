<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\ProductRequest;
use App\Repositories\AttributeRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CityRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StateRepository;
use App\Repositories\UnitRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductRepository   $productRepository,
                                private CategoryRepository  $categoryRepository,
                                private UnitRepository      $unitRepository,
                                private StateRepository     $stateRepository,
                                private CityRepository      $cityRepository,
                                private AttributeRepository $attributeRepository
    )
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepository->getAll();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryRepository->getActiveCategories();
        $units = $this->unitRepository->getAll();
        $products = $this->productRepository->getActiveProducts();
        $states = $this->stateRepository->getAll();
        $cities = $this->cityRepository->getAll();
        $attributes = $this->attributeRepository->getActiveAttributes();
        return view('dashboard.products.create', compact('categories', 'units', 'products', 'states', 'cities','attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->productRepository->create($request);
        return redirect()->route('products.index')->with('add-success',__('success_messages.product.add.success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->productRepository->find($id);
        $isComplex = $product->attributes->count() > 0;
        return view('dashboard.products.show',compact('product','isComplex'));
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
        $this->productRepository->delete($id);
        return redirect()->back()->with('delete-success', __('success_messages.product.delete.success'));
    }
}
