<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class PengajuanRequest extends FormRequest
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
            'barcode_id' => 'required|unique',
            'site_id' => 'required|exists:site,id',
            'jenis_id' => 'required|exists:jenis,id',
            'kategori_id' => 'required|exists:kategori,id',
            'pekerjaan_id' => 'required|exists:pekerjaan,id',
            'project_id' => 'required|exists:project,id',
            'pengaju_id' => 'required|exists:user,id',
            'target_id' => 'required|exists:user,id',
            'deskripsi' => 'required|min:5|max:100',
            'keterangan' => 'nullable',
            'tanggal_pengajuan' => 'required|date',
            'realisasi_pengajuan' => 'required|date',
            'start_penawaran_to_dmt' => 'nullable|date',
            'no_sph' => 'nullable|required_with:nominal_sph',
            'nominal_sph' => 'nullable|numeric|required_with:no_sph',
            'no_corr' => 'nullable|required_with:nominal_corr',
            'nominal_corr' => 'nullable|numeric|required_with:no_corr',
            'no_po' => 'nullable|required_with:nominal_po',
            'nominal_po' => 'nullable|numeric|required_with:no_po',
            'no_spk' => 'nullable',
            'nominal_pengajuan' => 'required|numeric',
            'approved_at' => 'nullable|date|required_if:is_approved,1',
            'is_approved' => 'nullable',
            'rejected_at' => 'nullable|date|required_if:is_rejected,1',
            'is_rejected' => 'nullable',
            'printed_at' => 'nullable|date|required_if:is_print,1',
            'is_print' => 'nullable',
            'is_accepted' => 'nullable',
            'is_deleted' => 'nullable',
            'is_completed' => 'nullable'
        ];
    }
}
