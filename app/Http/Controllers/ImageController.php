<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{

    public static function routeName(){
        return Str::snake("Image");
    }
    public function __construct(Request $request){
        parent::__construct($request);
        // $this->authorizeResource(Image::class,Str::snake("Image"));
    }
    public function index(Request $request)
    {
        return ImageResource::collection(Image::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StoreImageRequest $request)
    {
        $image = Image::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $image->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new ImageResource($image);
    }
    public function show(Request $request,Image $image)
    {
        return new ImageResource($image);
    }
    public function update(UpdateImageRequest $request, Image $image)
    {
        $image->update($request->validated());
          if ($request->translations) {
            foreach ($request->translations as $translation)
                $image->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new ImageResource($image);
    }
    public function destroy(Request $request,Image $image)
    {
        $image->delete();
        return new ImageResource($image);
    }
}
