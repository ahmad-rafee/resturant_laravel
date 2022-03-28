<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table="REST_DISCOUNT";
    protected $primaryKey = 'DISC_SERIAL';
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public static function createRules($user)
    {
        return  [
            'DISC_DESCIPTION'=>'required',
            'DISC_TYPE'=>'required',
            'DISC_STATUS'=>'required',
            'DISC_STARTE_DATE'=>'required',
            'DISC_END_DATE'=>'required',
            'DISC_VALUE'=>'required',
            'DISC_PCT'=>'required',
            'DISC_PRICE_LIST'=>'required',
            'DISC_USER_ROLE'=>'required',
            'DISC_APPLAY_TO'=>'required',
        ];
    }
    public static function updateRules($user)
    {
        return  [
            'DISC_DESCIPTION'=>'required',
            'DISC_TYPE'=>'required',
            'DISC_STATUS'=>'required',
            'DISC_STARTE_DATE'=>'required',
            'DISC_END_DATE'=>'required',
            'DISC_VALUE'=>'required',
            'DISC_PCT'=>'required',
            'DISC_PRICE_LIST'=>'required',
            'DISC_USER_ROLE'=>'required',
            'DISC_APPLAY_TO'=>'required',
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
