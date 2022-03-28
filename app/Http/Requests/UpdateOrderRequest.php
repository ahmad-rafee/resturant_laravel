<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
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
}
