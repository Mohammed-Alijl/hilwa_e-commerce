<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\AttributeRequest;
use App\Repositories\AttributeRepository;
use App\Repositories\EntityRepository;
use App\Repositories\LanguageRepository;

class AttributeController extends Controller
{
    function __construct(private AttributeRepository $attributeRepository,
                         private LanguageRepository  $languageRepository
    )
    {
        $this->middleware('permission:view_attribute', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_attribute', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_attribute', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_attribute', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = $this->attributeRepository->getAll();
        $rowNumber = 1;
        return view('dashboard.attributes.index', compact('attributes', 'rowNumber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeRequest $request)
    {
        $this->attributeRepository->create($request);
        return redirect()->route('attributes.index')->with('add-success', __('success_messages.attribute.add.success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attribute = $this->attributeRepository->find($id);
        $values = $this->attributeRepository->getAttributeValues($id);
        return view('dashboard.attributes.show',compact('values','attribute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $languages = $this->languageRepository->getAll();
        $attribute = $this->attributeRepository->find($id);
        return view('dashboard.attributes.edit', compact('languages', 'attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttributeRequest $request, string $id)
    {
        $this->attributeRepository->update($request, $id);
        return redirect()->route('attributes.index')->with('edit-success', __('success_messages.attribute.edit.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->attributeRepository->delete($id);
        return redirect()->route('attributes.index')->with('delete-success', __('success_messages.attribute.delete.success'));
    }

    public function getAttributeLanguages($langId, $attributeId)
    {
        $attributeTranslation = $this->attributeRepository->getAttributeLanguages($langId, $attributeId);

        if (!$attributeTranslation) {
            return json_decode('');
        }
        return response()->json(['attribute_name' => $attributeTranslation->name]);
    }
}
