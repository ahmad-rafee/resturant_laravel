<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $table="REST_Meals";
    
    use HasFactory;
    protected $primaryKey = 'MEL_ID';
    protected $guarded = [];
    public $timestamps = false;
    protected $appends = ['image'];
    public static function createRules($user)
    {
        return  [
            'MEL_ArbName'=>'required',
            'MEL_EngName'=>'required',
            'MEL_CatID'=>'required',
            'MEL_Order'=>'required',
            'MEL_Price'=>'required',
            'MEL_Logo'=>'required',
            'MEL_Desc'=>'required',
            'MEL_DefaultKitchen'=>'required',
            'MEL_Status'=>'required',
            'MEL_Price2'=>'required',
        ];
    }
    public static function updateRules($user)
    {
        return  [
            'MEL_ArbName'=>'required',
            'MEL_EngName'=>'required',
            'MEL_CatID'=>'required',
            'MEL_Order'=>'required',
            'MEL_Price'=>'required',
            'MEL_Logo'=>'required',
            'MEL_Desc'=>'required',
            'MEL_DefaultKitchen'=>'required',
            'MEL_Status'=>'required',
            'MEL_Price2'=>'required',
        ];
    }
    public function scopeSearch($query, $request)
    {
        $locale = app()->getLocale();
        // $query->orderBy('bills.created_at', 'desc');
        $query->when($request->name, function ($query, $name) use ($locale) {
            $query->where("name->$locale", 'like', "%$name%");
        });
    }
    public function scopeSort($query, $request)
    {
        $sortBy = $request->sortBy;
        $sortDesc = $request->sortDesc;
        $custom_fields = [];
        if ($sortBy && $sortDesc) {
            foreach ($sortBy as $index => $field) {
                $desc = $sortDesc[$index] ? "desc" : "asc";
                if (!isset($custom_fields[$field])) {
                    $query->orderBy($field, $desc);
                } else {
                    $custom_fields[$field]($query, $desc);
                }
            }
        }
    }
    public function logo(){
        return $this->hasOne(Image::class,'IMG_ID','MEL_Logo');
    }
    public function getImageAttribute(){
        return $this->logo?->IMG_DATA;
    }
}
