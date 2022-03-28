<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreDiscountUserRequest;
use App\Http\Requests\UpdateDiscountUserRequest;
use App\Http\Resources\DiscountUserResource;
use App\Models\DiscountUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class DiscountUserController extends Controller
{

    public static function routeName(){
        return Str::snake("DiscountUser");
    }
    public function __construct(Request $request){
        parent::__construct($request);
        $this->authorizeResource(DiscountUser::class,Str::snake("DiscountUser"));
    }
    public function index(Request $request)
    {
        return DiscountUserResource::collection(DiscountUser::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StoreDiscountUserRequest $request)
    {
        $discountUser = DiscountUser::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $discountUser->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new DiscountUserResource($discountUser);
    }
    public function show(Request $request,DiscountUser $discountUser)
    {
        return new DiscountUserResource($discountUser);
    }
    public function update(UpdateDiscountUserRequest $request, DiscountUser $discountUser)
    {
        $discountUser->update($request->validated());
          if ($request->translations) {
            foreach ($request->translations as $translation)
                $discountUser->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new DiscountUserResource($discountUser);
    }
    public function destroy(Request $request,DiscountUser $discountUser)
    {
        $discountUser->delete();
        return new DiscountUserResource($discountUser);
    }
}
