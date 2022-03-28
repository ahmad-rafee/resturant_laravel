<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "REST_OrderDetails";
    protected $primaryKey = 'ORDD_Serial';
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public static function createRules($user)
    {
        return  [
            'ORDD_OrderID' => 'required',
            'ORDD_TableID' => 'required',
            'ORDD_MealID' => 'required',
            'ORDD_CustomerID' => 'required',
            'ORDD_StartTime' => 'required',
            'ORDD_EndTime' => 'required',
            'ORDD_Discount' => 'required',
            'ORDD_Status' => 'required',
            'ORDD_Quantity' => 'required',
            'ORDD_Total' => 'required',
            'ORDD_Type' => 'required',
            'ORDD_Price' => 'required',
            'ORDD_Notes' => 'required',
            'ORDD_DeleteReason' => 'required',
            'ORDD_OrderNo' => 'required',
            'ORDD_OrderTime' => 'required',
            'ORDD_IsPrinted' => 'required',
        ];
    }
    public static function updateRules($user)
    {
        return  [
            'ORDD_OrderID' => 'required',
            'ORDD_TableID' => 'required',
            'ORDD_MealID' => 'required',
            'ORDD_CustomerID' => 'required',
            'ORDD_StartTime' => 'required',
            'ORDD_EndTime' => 'required',
            'ORDD_Discount' => 'required',
            'ORDD_Status' => 'required',
            'ORDD_Quantity' => 'required',
            'ORDD_Total' => 'required',
            'ORDD_Type' => 'required',
            'ORDD_Price' => 'required',
            'ORDD_Notes' => 'required',
            'ORDD_DeleteReason' => 'required',
            'ORDD_OrderNo' => 'required',
            'ORDD_OrderTime' => 'required',
            'ORDD_IsPrinted' => 'required',
        ];
    }
    public function scopeSearch($query, $request)
    {
        $locale = app()->getLocale();
        // $query->orderBy('bills.created_at', 'desc');
        $query->when($request->ORDD_OrderID, function ($query, $ORDD_OrderID) use ($locale) {
            $query->where("ORDD_OrderID", $ORDD_OrderID);
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
