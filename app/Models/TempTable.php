<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempTable extends Model
{
    protected $table = "REST_TempTable";
    protected $primaryKey = 'TMP_TableID';
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    
    public static function createRules($user)
    {
        return  [
            'TMP_Type' => 'required',
            'TMP_OpenTime' => 'required',
            'TMP_CloseTime' => 'required',
            'TMP_CustomerID' => 'required',
            'TMP_WaiterID' => 'required',
            'TMP_GuestCount' => 'required',
            'TMP_Status' => 'required',
            'TMP_Total' => 'required',
            'TMP_Discount' => 'required',
            'TMP_UserID' => 'required',
            'TMP_Notes' => 'required',
            'TMP_OrderID' => 'required',
        ];
    }
    public static function updateRules($user)
    {
        return  [
            'TMP_Type' => 'required',
            'TMP_OpenTime' => 'required',
            'TMP_CloseTime' => 'required',
            'TMP_CustomerID' => 'required',
            'TMP_WaiterID' => 'required',
            'TMP_GuestCount' => 'required',
            'TMP_Status' => 'required',
            'TMP_Total' => 'required',
            'TMP_Discount' => 'required',
            'TMP_UserID' => 'required',
            'TMP_Notes' => 'required',
            'TMP_OrderID' => 'required',
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
