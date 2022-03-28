<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'ORD_Type' => 'nullable',
            'ORD_TableID' => 'required',
            'ORD_StartTime' => 'nullable',
            'ORD_ReadyAt' => 'nullable',
            'ORD_EndTime' => 'nullable',
            'ORD_CustomerID' => 'nullable',
            'ORD_Status' => 'nullable',
            'ORD_Total' => 'nullable',
            'ORD_OrderNo' => 'nullable',
            'ORD_LOG_SERIAL' => 'nullable',
            'ORD_TotalDiscount' => 'nullable',
            'ORD_NOTES' => 'nullable',
            'ORD_BIL_SERIAL' => 'nullable',
            'ORD_ReceviedCashPayment' => 'nullable',
            'ORD_UserSerial' => 'nullable',
            'ORD_UserDeviceName' => 'nullable',
            'ORD_IncrementalID' => 'nullable',
            'ORD_IsPosted' => 'nullable',
            'ORD_DeleteReason' => 'nullable',

        ];
    }
}
