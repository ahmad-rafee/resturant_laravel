<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreHallDecorRequest;
use App\Http\Requests\UpdateHallDecorRequest;
use App\Http\Resources\HallDecorResource;
use App\Models\HallDecor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class HallDecorController extends Controller
{

    public static function routeName(){
        return Str::snake("HallDecor");
    }
    public function __construct(Request $request){
        parent::__construct($request);
        // $this->authorizeResource(HallDecor::class,Str::snake("HallDecor"));
    }
    public function index(Request $request)
    {
        return HallDecorResource::collection(HallDecor::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StoreHallDecorRequest $request)
    {
        $hallDecor = HallDecor::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $hallDecor->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new HallDecorResource($hallDecor);
    }
    public function show(Request $request,HallDecor $hallDecor)
    {
        return new HallDecorResource($hallDecor);
    }
    public function update(UpdateHallDecorRequest $request, HallDecor $hallDecor)
    {
        $hallDecor->update($request->validated());
          if ($request->translations) {
            foreach ($request->translations as $translation)
                $hallDecor->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new HallDecorResource($hallDecor);
    }
    public function destroy(Request $request,HallDecor $hallDecor)
    {
        $hallDecor->delete();
        return new HallDecorResource($hallDecor);
    }
}
