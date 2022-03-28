<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWaiterRequest extends FormRequest
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
}
