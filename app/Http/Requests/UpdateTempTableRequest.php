<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTempTableRequest extends FormRequest
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
}
