<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class PekerjaanRequest extends FormRequest
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
            'pekerjaan' => 'required|max:50',
            'site_id' => 'required|exists:site,id',
            'project_id' => 'required|exists:project,id',
        ];
    }
}
