<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreDecorTypeRequest;
use App\Http\Requests\UpdateDecorTypeRequest;
use App\Http\Resources\DecorTypeResource;
use App\Models\DecorType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class DecorTypeController extends Controller
{

    public static function routeName(){
        return Str::snake("DecorType");
    }
    public function __construct(Request $request){
        parent::__construct($request);
        // $this->authorizeResource(DecorType::class,Str::snake("DecorType"));
    }
    public function index(Request $request)
    {
        return DecorTypeResource::collection(DecorType::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StoreDecorTypeRequest $request)
    {
        $decorType = DecorType::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $decorType->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new DecorTypeResource($decorType);
    }
    public function show(Request $request,DecorType $decorType)
    {
        return new DecorTypeResource($decorType);
    }
    public function update(UpdateDecorTypeRequest $request, DecorType $decorType)
    {
        $decorType->update($request->validated());
          if ($request->translations) {
            foreach ($request->translations as $translation)
                $decorType->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new DecorTypeResource($decorType);
    }
    public function destroy(Request $request,DecorType $decorType)
    {
        $decorType->delete();
        return new DecorTypeResource($decorType);
    }
}
