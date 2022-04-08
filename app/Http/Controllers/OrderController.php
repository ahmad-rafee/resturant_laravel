<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public static function routeName()
    {
        return Str::snake("Order");
    }
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // $this->authorizeResource(Order::class,Str::snake("Order"));
    }
    public function index(Request $request)
    {
        return OrderResource::collection(Order::search($request)->sort($request)->paginate((request('per_page') ?? request('itemsPerPage')) ?? 15));
    }
    public function store(StoreOrderRequest $request)
    {
        $last_draft_order = Order::where('ORD_Status', '=', 0)->first();
        if (!$last_draft_order)
            $order = Order::create($request->validated());
        else
            $order = $last_draft_order->update($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $order->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new OrderResource($order);
    }
    public function show(Request $request, Order $order)
    {
        return new OrderResource($order);
    }
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $order->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new OrderResource($order);
    }
    public function destroy(Request $request, Order $order)
    {
        $order->delete();
        return new OrderResource($order);
    }
}
