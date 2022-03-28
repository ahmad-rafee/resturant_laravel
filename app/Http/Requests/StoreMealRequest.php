<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMealRequest extends FormRequest
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
            'MEL_ArbName' => 'required',
            'MEL_EngName' => 'required',
            'MEL_CatID' => 'required',
            'MEL_Order' => 'required',
            'MEL_Price' => 'required',
            'MEL_Logo' => 'required',
            'MEL_Desc' => 'required',
            'MEL_DefaultKitchen' => 'required',
            'MEL_Status' => 'required',
            'MEL_Price2' => 'required',

        ];
    }
}
