<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreOrderOptionRequest;
use App\Http\Requests\UpdateOrderOptionRequest;
use App\Http\Resources\OrderOptionResource;
use App\Models\OrderOption;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class OrderOptionController extends Controller
{

    public static function routeName(){
        return Str::snake("OrderOption");
    }
    public function __construct(Request $request){
        parent::__construct($request);
        // $this->authorizeResource(OrderOption::class,Str::snake("OrderOption"));
    }
    public function index(Request $request)
    {
        return OrderOptionResource::collection(OrderOption::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StoreOrderOptionRequest $request)
    {
        $orderOption = OrderOption::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $orderOption->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new OrderOptionResource($orderOption);
    }
    public function show(Request $request,OrderOption $orderOption)
    {
        return new OrderOptionResource($orderOption);
    }
    public function update(UpdateOrderOptionRequest $request, OrderOption $orderOption)
    {
        $orderOption->update($request->validated());
          if ($request->translations) {
            foreach ($request->translations as $translation)
                $orderOption->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new OrderOptionResource($orderOption);
    }
    public function destroy(Request $request,OrderOption $orderOption)
    {
        $orderOption->delete();
        return new OrderOptionResource($orderOption);
    }
}
