<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
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
            'NTF_MSG'=>'required',
            'NTF_CREATOR'=>'required',
            'NTF_TOUSER'=>'required',
            'NTF_CREATEDATE'=>'required',
            'NTF_TYPE'=>'required',
            'NTF_ISREAD'=>'required',
 
        ];
    }
}
