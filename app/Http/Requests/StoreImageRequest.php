<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
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
            'IMG_DESCRIPTION' => 'required',
            'IMG_DATA' => 'required',
            'IMG_CREATE_DATE' => 'required',
            'IMG_USER_UPLOAD' => 'required',
            'IMG_TYPE' => 'required',

        ];
    }
}
