<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderDetailRequest extends FormRequest
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
}
