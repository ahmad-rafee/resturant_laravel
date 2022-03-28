<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreTempTableRequest;
use App\Http\Requests\UpdateTempTableRequest;
use App\Http\Resources\TempTableResource;
use App\Models\TempTable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class TempTableController extends Controller
{

    public static function routeName(){
        return Str::snake("TempTable");
    }
    public function __construct(Request $request){
        parent::__construct($request);
        $this->authorizeResource(TempTable::class,Str::snake("TempTable"));
    }
    public function index(Request $request)
    {
        return TempTableResource::collection(TempTable::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StoreTempTableRequest $request)
    {
        $tempTable = TempTable::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $tempTable->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new TempTableResource($tempTable);
    }
    public function show(Request $request,TempTable $tempTable)
    {
        return new TempTableResource($tempTable);
    }
    public function update(UpdateTempTableRequest $request, TempTable $tempTable)
    {
        $tempTable->update($request->validated());
          if ($request->translations) {
            foreach ($request->translations as $translation)
                $tempTable->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new TempTableResource($tempTable);
    }
    public function destroy(Request $request,TempTable $tempTable)
    {
        $tempTable->delete();
        return new TempTableResource($tempTable);
    }
}
