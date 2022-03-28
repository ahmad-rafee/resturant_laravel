<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealContent extends Model
{
    protected $table="REST_MealContent";
    protected $primaryKey = 'MCT_Serial';
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public static function createRules($user)
    {
        return  [
            'MCT_MealID'=>'required',
            'MCT_ItemNo'=>'required',
            'MCT_StoreNo'=>'required',
            'MCT_Quantity'=>'required',
            'MCT_UnitNo'=>'required',
            'MCT_Notes'=>'required',
        ];
    }
    public static function updateRules($user)
    {
        return  [
            'MCT_MealID'=>'required',
            'MCT_ItemNo'=>'required',
            'MCT_StoreNo'=>'required',
            'MCT_Quantity'=>'required',
            'MCT_UnitNo'=>'required',
            'MCT_Notes'=>'required',
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
}
