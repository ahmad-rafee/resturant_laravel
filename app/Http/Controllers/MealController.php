<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreMealRequest;
use App\Http\Requests\UpdateMealRequest;
use App\Http\Resources\MealResource;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class MealController extends Controller
{

    public static function routeName(){
        return Str::snake("Meal");
    }
    public function __construct(Request $request){
        parent::__construct($request);
        $this->authorizeResource(Meal::class,Str::snake("Meal"));
    }
    public function index(Request $request)
    {
        return MealResource::collection(Meal::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StoreMealRequest $request)
    {
        $meal = Meal::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $meal->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new MealResource($meal);
    }
    public function show(Request $request,Meal $meal)
    {
        return new MealResource($meal);
    }
    public function update(UpdateMealRequest $request, Meal $meal)
    {
        $meal->update($request->validated());
          if ($request->translations) {
            foreach ($request->translations as $translation)
                $meal->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new MealResource($meal);
    }
    public function destroy(Request $request,Meal $meal)
    {
        $meal->delete();
        return new MealResource($meal);
    }
}
