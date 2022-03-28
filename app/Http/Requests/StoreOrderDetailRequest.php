<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderDetailRequest extends FormRequest
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
            'ORDD_OrderID' => 'nullable',
            'ORDD_TableID' => 'nullable',
            'ORDD_MealID' => 'required',
            'ORDD_CustomerID' => 'nullable',
            'ORDD_StartTime' => 'nullable',
            'ORDD_EndTime' => 'nullable',
            'ORDD_Discount' => 'nullable',
            'ORDD_Status' => 'nullable',
            'ORDD_Quantity' => 'nullable',
            'ORDD_Total' => 'nullable',
            'ORDD_Type' => 'nullable',
            'ORDD_Price' => 'nullable',
            'ORDD_Notes' => 'nullable',
            'ORDD_DeleteReason' => 'nullable',
            'ORDD_OrderNo' => 'nullable',
            'ORDD_OrderTime' => 'nullable',
            'ORDD_IsPrinted' => 'nullable',
        ];
    }
}
