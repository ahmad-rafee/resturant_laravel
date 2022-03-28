<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreKitchenRequest;
use App\Http\Requests\UpdateKitchenRequest;
use App\Http\Resources\KitchenResource;
use App\Models\Kitchen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class KitchenController extends Controller
{

    public static function routeName(){
        return Str::snake("Kitchen");
    }
    public function __construct(Request $request){
        parent::__construct($request);
        $this->authorizeResource(Kitchen::class,Str::snake("Kitchen"));
    }
    public function index(Request $request)
    {
        return KitchenResource::collection(Kitchen::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StoreKitchenRequest $request)
    {
        $kitchen = Kitchen::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $kitchen->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new KitchenResource($kitchen);
    }
    public function show(Request $request,Kitchen $kitchen)
    {
        return new KitchenResource($kitchen);
    }
    public function update(UpdateKitchenRequest $request, Kitchen $kitchen)
    {
        $kitchen->update($request->validated());
          if ($request->translations) {
            foreach ($request->translations as $translation)
                $kitchen->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new KitchenResource($kitchen);
    }
    public function destroy(Request $request,Kitchen $kitchen)
    {
        $kitchen->delete();
        return new KitchenResource($kitchen);
    }
}
