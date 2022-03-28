<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountRequest extends FormRequest
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
            'DISC_DESCIPTION'=>'required',
            'DISC_TYPE'=>'required',
            'DISC_STATUS'=>'required',
            'DISC_STARTE_DATE'=>'required',
            'DISC_END_DATE'=>'required',
            'DISC_VALUE'=>'required',
            'DISC_PCT'=>'required',
            'DISC_PRICE_LIST'=>'required',
            'DISC_USER_ROLE'=>'required',
            'DISC_APPLAY_TO'=>'required',
        
        ];
    }
}
