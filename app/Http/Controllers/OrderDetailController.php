<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreOrderDetailRequest;
use App\Http\Requests\UpdateOrderDetailRequest;
use App\Http\Resources\OrderDetailResource;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class OrderDetailController extends Controller
{

    public static function routeName(){
        return Str::snake("OrderDetail");
    }
    public function __construct(Request $request){
        parent::__construct($request);
        $this->authorizeResource(OrderDetail::class,Str::snake("OrderDetail"));
    }
    public function index(Request $request)
    {
        return OrderDetailResource::collection(OrderDetail::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StoreOrderDetailRequest $request)
    {
        $orderDetail = OrderDetail::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $orderDetail->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new OrderDetailResource($orderDetail);
    }
    public function show(Request $request,OrderDetail $orderDetail)
    {
        return new OrderDetailResource($orderDetail);
    }
    public function update(UpdateOrderDetailRequest $request, OrderDetail $orderDetail)
    {
        $orderDetail->update($request->validated());
          if ($request->translations) {
            foreach ($request->translations as $translation)
                $orderDetail->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new OrderDetailResource($orderDetail);
    }
    public function destroy(Request $request,OrderDetail $orderDetail)
    {
        $orderDetail->delete();
        return new OrderDetailResource($orderDetail);
    }
}
