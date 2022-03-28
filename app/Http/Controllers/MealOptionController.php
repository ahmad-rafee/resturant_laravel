<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreMealOptionRequest;
use App\Http\Requests\UpdateMealOptionRequest;
use App\Http\Resources\MealOptionResource;
use App\Models\MealOption;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class MealOptionController extends Controller
{

    public static function routeName(){
        return Str::snake("MealOption");
    }
    public function __construct(Request $request){
        parent::__construct($request);
        $this->authorizeResource(MealOption::class,Str::snake("MealOption"));
    }
    public function index(Request $request)
    {
        return MealOptionResource::collection(MealOption::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StoreMealOptionRequest $request)
    {
        $mealOption = MealOption::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $mealOption->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new MealOptionResource($mealOption);
    }
    public function show(Request $request,MealOption $mealOption)
    {
        return new MealOptionResource($mealOption);
    }
    public function update(UpdateMealOptionRequest $request, MealOption $mealOption)
    {
        $mealOption->update($request->validated());
          if ($request->translations) {
            foreach ($request->translations as $translation)
                $mealOption->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new MealOptionResource($mealOption);
    }
    public function destroy(Request $request,MealOption $mealOption)
    {
        $mealOption->delete();
        return new MealOptionResource($mealOption);
    }
}
