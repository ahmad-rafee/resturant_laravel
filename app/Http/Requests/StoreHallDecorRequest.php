<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHallDecorRequest extends FormRequest
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
            'DEC_HALLID' => 'required',
            'DEC_TableNo' => 'required',
            'DEC_Name' => 'required',
            'DEC_TypeID' => 'required',
            'DEC_Status' => 'required',
            'DEC_Image' => 'required',
            'DEC_Left' => 'required',
            'DEC_Top' => 'required',
    
        ];
    }
}
