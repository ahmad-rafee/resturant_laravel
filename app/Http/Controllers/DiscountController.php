<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;
use App\Http\Resources\DiscountResource;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{

    public static function routeName(){
        return Str::snake("Discount");
    }
    public function __construct(Request $request){
        parent::__construct($request);
        $this->authorizeResource(Discount::class,Str::snake("Discount"));
    }
    public function index(Request $request)
    {
        return DiscountResource::collection(Discount::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StoreDiscountRequest $request)
    {
        $discount = Discount::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $discount->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new DiscountResource($discount);
    }
    public function show(Request $request,Discount $discount)
    {
        return new DiscountResource($discount);
    }
    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        $discount->update($request->validated());
          if ($request->translations) {
            foreach ($request->translations as $translation)
                $discount->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new DiscountResource($discount);
    }
    public function destroy(Request $request,Discount $discount)
    {
        $discount->delete();
        return new DiscountResource($discount);
    }
}
