<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBeneficiaryRequest extends FormRequest
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
            'BEN_Name' => 'required',
            'BEN_CompanyOwner' => 'required',
            'BEN_ContactPerson' => 'required',
            'BEN_WorkField' => 'required',
            'BEN_LisNo' => 'required',
            'BEN_AccFather' => 'required',
            'BEN_Account' => 'required',
            'BEN_Status' => 'required',
            'BEN_Type' => 'required',
            'BEN_CatNo' => 'required',
            'BEN_Address' => 'required',
            'BEN_Tel' => 'required',
            'BEN_Fax' => 'required',
            'BEN_Mobile' => 'required',
            'BEN_Mers' => 'required',
            'BEN_Email' => 'required',
            'BEN_URL' => 'required',
            'BEN_Notes' => 'required',
            'Ben_IsStoreClient' => 'required',
            'BEN_StoreNo' => 'required',
            'BEN_BirthDate' => 'required',
            'BEN_Image' => 'required',
            'BEN_RefNo' => 'required',
            'BEN_Points' => 'required',
            'BEN_MaxDebit' => 'required',
            'BEN_TaxLicenseNo' => 'required',
        ];
    }
}
