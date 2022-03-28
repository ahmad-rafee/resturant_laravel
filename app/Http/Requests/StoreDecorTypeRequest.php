<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDecorTypeRequest extends FormRequest
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
            'DTYP_Name' => 'required',
            'DTTYP_Name' => 'required',
            'DTYP_Description' => 'required',
            'DTYP_Logo' => 'required',
            'DTYP_CanReserve' => 'required',
   
        ];
    }
}
