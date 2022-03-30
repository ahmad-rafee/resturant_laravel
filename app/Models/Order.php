<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "REST_Orders";
    protected $primaryKey = 'ORD_ID';
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    protected $appends = ['customer_name','table_name'];
    public static function createRules($user)
    {
        return  [
            'ORD_Type' => 'required',
            'ORD_TableID' => 'required',
            'ORD_StartTime' => 'required',
            'ORD_ReadyAt' => 'required',
            'ORD_EndTime' => 'required',
            'ORD_CustomerID' => 'required',
            'ORD_Status' => 'required',
            'ORD_Total' => 'required',
            'ORD_OrderNo' => 'required',
            'ORD_LOG_SERIAL' => 'required',
            'ORD_TotalDiscount' => 'required',
            'ORD_NOTES' => 'required',
            'ORD_BIL_SERIAL' => 'required',
            'ORD_ReceviedCashPayment' => 'required',
            'ORD_UserSerial' => 'required',
            'ORD_UserDeviceName' => 'required',
            'ORD_IncrementalID' => 'required',
            'ORD_IsPosted' => 'required',
            'ORD_DeleteReason' => 'required',
        ];
    }
    public static function updateRules($user)
    {
        return  [
            'ORD_Type' => 'required',
            'ORD_TableID' => 'required',
            'ORD_StartTime' => 'required',
            'ORD_ReadyAt' => 'required',
            'ORD_EndTime' => 'required',
            'ORD_CustomerID' => 'required',
            'ORD_Status' => 'required',
            'ORD_Total' => 'required',
            'ORD_OrderNo' => 'required',
            'ORD_LOG_SERIAL' => 'required',
            'ORD_TotalDiscount' => 'required',
            'ORD_NOTES' => 'required',
            'ORD_BIL_SERIAL' => 'required',
            'ORD_ReceviedCashPayment' => 'required',
            'ORD_UserSerial' => 'required',
            'ORD_UserDeviceName' => 'required',
            'ORD_IncrementalID' => 'required',
            'ORD_IsPosted' => 'required',
            'ORD_DeleteReason' => 'required',
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
    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class, 'ORD_CustomerID','BEN_No');
    }
    public function order_table(){
        return $this->belongsTo(HallDecor::class,'ORD_TableID','DEC_ID');
    }
    public function getCustomerNameAttribute(){
        return $this->beneficiary?->BEN_Name;
    }
    public function getTableNameAttribute(){
        return $this->order_table?->DEC_Name;
    }
}
