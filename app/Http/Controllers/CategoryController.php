<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class CategoryController extends Controller
{

    public static function routeName()
    {
        return Str::snake("Category");
    }
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->authorizeResource(Category::class, Str::snake("Category"));
    }
    public function index(Request $request)
    {
        return CategoryResource::collection(Category::search($request)->sort($request)->paginate((request('per_page') ?? request('itemsPerPage')) ?? 15));
    }
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $category->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new CategoryResource($category);
    }
    public function show(Request $request, Category $category)
    {
        return new CategoryResource($category);
    }
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $category->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new CategoryResource($category);
    }
    public function destroy(Request $request, Category $category)
    {
        $category->delete();
        return new CategoryResource($category);
    }
}
