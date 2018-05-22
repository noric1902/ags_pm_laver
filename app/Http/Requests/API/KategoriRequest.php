<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class KategoriRequest extends FormRequest
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
            'kategori_pengajuan' => 'required|max:50',
            'jenis_id' => 'required|integer|exists:jenis,id',
        ];
    }
}
