<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waiter extends Model
{
    protected $table = "REST_WAITER";
    use HasFactory;
    protected $primaryKey = 'WTR_ID';
    protected $guarded = [];
    public $timestamps = false;
    
    public static function createRules($user)
    {
        return  [
            'WTR_CUSTOMER_ID' => 'required',
            'WTR_TYPE' => 'required',
            'WTR_STATUS' => 'required',
            'WTR_START_DATE' => 'required',
            'WTR_END_DATE' => 'required',
            'WTR_DefaultKitchen' => 'required',
            'WTR_UserID' => 'required',
            'WTR_PIN' => 'required',
            'WTR_UseTablet' => 'required',
            'WTR_JobTitle' => 'required',
        ];
    }
    public static function updateRules($user)
    {
        return  [
            'WTR_CUSTOMER_ID' => 'required',
            'WTR_TYPE' => 'required',
            'WTR_STATUS' => 'required',
            'WTR_START_DATE' => 'required',
            'WTR_END_DATE' => 'required',
            'WTR_DefaultKitchen' => 'required',
            'WTR_UserID' => 'required',
            'WTR_PIN' => 'required',
            'WTR_UseTablet' => 'required',
            'WTR_JobTitle' => 'required',
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
