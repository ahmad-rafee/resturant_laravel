<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreMealContentRequest;
use App\Http\Requests\UpdateMealContentRequest;
use App\Http\Resources\MealContentResource;
use App\Models\MealContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class MealContentController extends Controller
{

    public static function routeName(){
        return Str::snake("MealContent");
    }
    public function __construct(Request $request){
        parent::__construct($request);
        // $this->authorizeResource(MealContent::class,Str::snake("MealContent"));
    }
    public function index(Request $request)
    {
        return MealContentResource::collection(MealContent::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StoreMealContentRequest $request)
    {
        $mealContent = MealContent::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $mealContent->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new MealContentResource($mealContent);
    }
    public function show(Request $request,MealContent $mealContent)
    {
        return new MealContentResource($mealContent);
    }
    public function update(UpdateMealContentRequest $request, MealContent $mealContent)
    {
        $mealContent->update($request->validated());
          if ($request->translations) {
            foreach ($request->translations as $translation)
                $mealContent->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new MealContentResource($mealContent);
    }
    public function destroy(Request $request,MealContent $mealContent)
    {
        $mealContent->delete();
        return new MealContentResource($mealContent);
    }
}
