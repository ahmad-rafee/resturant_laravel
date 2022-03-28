<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Http\Resources\OptionResource;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class OptionController extends Controller
{

    public static function routeName(){
        return Str::snake("Option");
    }
    public function __construct(Request $request){
        parent::__construct($request);
        $this->authorizeResource(Option::class,Str::snake("Option"));
    }
    public function index(Request $request)
    {
        return OptionResource::collection(Option::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StoreOptionRequest $request)
    {
        $option = Option::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $option->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new OptionResource($option);
    }
    public function show(Request $request,Option $option)
    {
        return new OptionResource($option);
    }
    public function update(UpdateOptionRequest $request, Option $option)
    {
        $option->update($request->validated());
          if ($request->translations) {
            foreach ($request->translations as $translation)
                $option->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new OptionResource($option);
    }
    public function destroy(Request $request,Option $option)
    {
        $option->delete();
        return new OptionResource($option);
    }
}
