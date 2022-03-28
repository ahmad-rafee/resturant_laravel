<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreRefreshRequest;
use App\Http\Requests\UpdateRefreshRequest;
use App\Http\Resources\RefreshResource;
use App\Models\Refresh;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class RefreshController extends Controller
{

    public static function routeName(){
        return Str::snake("Refresh");
    }
    public function __construct(Request $request){
        parent::__construct($request);
        $this->authorizeResource(Refresh::class,Str::snake("Refresh"));
    }
    public function index(Request $request)
    {
        return RefreshResource::collection(Refresh::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StoreRefreshRequest $request)
    {
        $refresh = Refresh::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $refresh->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new RefreshResource($refresh);
    }
    public function show(Request $request,Refresh $refresh)
    {
        return new RefreshResource($refresh);
    }
    public function update(UpdateRefreshRequest $request, Refresh $refresh)
    {
        $refresh->update($request->validated());
          if ($request->translations) {
            foreach ($request->translations as $translation)
                $refresh->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new RefreshResource($refresh);
    }
    public function destroy(Request $request,Refresh $refresh)
    {
        $refresh->delete();
        return new RefreshResource($refresh);
    }
}
