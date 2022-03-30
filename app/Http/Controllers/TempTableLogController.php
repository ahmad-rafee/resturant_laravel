<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreTempTableLogRequest;
use App\Http\Requests\UpdateTempTableLogRequest;
use App\Http\Resources\TempTableLogResource;
use App\Models\TempTableLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class TempTableLogController extends Controller
{

    public static function routeName(){
        return Str::snake("TempTableLog");
    }
    public function __construct(Request $request){
        parent::__construct($request);
        // $this->authorizeResource(TempTableLog::class,Str::snake("TempTableLog"));
    }
    public function index(Request $request)
    {
        return TempTableLogResource::collection(TempTableLog::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StoreTempTableLogRequest $request)
    {
        $tempTableLog = TempTableLog::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $tempTableLog->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new TempTableLogResource($tempTableLog);
    }
    public function show(Request $request,TempTableLog $tempTableLog)
    {
        return new TempTableLogResource($tempTableLog);
    }
    public function update(UpdateTempTableLogRequest $request, TempTableLog $tempTableLog)
    {
        $tempTableLog->update($request->validated());
          if ($request->translations) {
            foreach ($request->translations as $translation)
                $tempTableLog->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new TempTableLogResource($tempTableLog);
    }
    public function destroy(Request $request,TempTableLog $tempTableLog)
    {
        $tempTableLog->delete();
        return new TempTableLogResource($tempTableLog);
    }
}
