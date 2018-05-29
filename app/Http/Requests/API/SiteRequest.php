<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class SiteRequest extends FormRequest
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
            'site_id' => 'required|min:6|max:20',
            'site_type' => 'required',
            'site_name' => 'required|min:6|max:50',
            'lokasi' => 'required',
            'description' => 'nullable',
        ];
    }
}
