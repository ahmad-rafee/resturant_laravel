<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreHallRequest;
use App\Http\Requests\UpdateHallRequest;
use App\Http\Resources\HallResource;
use App\Models\Hall;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class HallController extends Controller
{

    public static function routeName(){
        return Str::snake("Hall");
    }
    public function __construct(Request $request){
        parent::__construct($request);
        $this->authorizeResource(Hall::class,Str::snake("Hall"));
    }
    public function index(Request $request)
    {
        return HallResource::collection(Hall::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StoreHallRequest $request)
    {
        $hall = Hall::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $hall->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new HallResource($hall);
    }
    public function show(Request $request,Hall $hall)
    {
        return new HallResource($hall);
    }
    public function update(UpdateHallRequest $request, Hall $hall)
    {
        $hall->update($request->validated());
          if ($request->translations) {
            foreach ($request->translations as $translation)
                $hall->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new HallResource($hall);
    }
    public function destroy(Request $request,Hall $hall)
    {
        $hall->delete();
        return new HallResource($hall);
    }
}
