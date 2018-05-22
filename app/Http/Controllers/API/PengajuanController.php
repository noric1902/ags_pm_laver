<?php

namespace App\Http\Controllers\API;

use App\Model\Pengajuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\PengajuanRequest;
use App\Http\Resources\PengajuanCollection;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Resource\PengajuanResource;

class PengajuanController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth:api')->except('index', 'show');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PengajuanCollection::collection(Pengajuan::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengajuanRequest $request)
    {
        $pengajuan = new Pengajuan;
        $pengajuan->barcode_id = $request->barcode_id;
        $pengajuan->site_id = $request->site_id;
        $pengajuan->jenis_id = $request->jenis_id;
        $pengajuan->kategori_id = $request->kategori_id;
        $pengajuan->pekerjaan_id = $request->pekerjaan_id;
        $pengajuan->project_id = $request->project_id;
        $pengajuan->pengaju_id = $request->pengaju_id;
        $pengajuan->target_id = $request->target_id;
        $pengajuan->deskripsi = $request->deskripsi;
        $pengajuan->keterangan = $request->keterangan;
        $pengajuan->tanggal_pengajuan = $request->tanggal_pengajuan;
        $pengajuan->realisasi_pengajuan = $request->realisasi_pengajuan;
        $pengajuan->start_penawaran_to_dmt = $request->start_penawaran_to_dmt;
        $pengajuan->no_sph = $request->no_sph;
        $pengajuan->nominal_sph = $request->nominal_sph;
        $pengajuan->no_corr = $request->no_corr;
        $pengajuan->nominal_corr = $request->nominal_corr;
        $pengajuan->no_po = $request->no_po;
        $pengajuan->nominal_po = $request->nominal_po;
        $pengajuan->no_spk = $request->no_spk;
        $pengajuan->nominal_pengajuan = $request->nominal_pengajuan;
        $pengajuan->approved_at = $request->approved_at;
        $pengajuan->is_approved = $request->is_approved;
        $pengajuan->rejected_at = $request->rejected_at;
        $pengajuan->is_rejected = $request->is_rejected;
        $pengajuan->printed_at = $request->printed_at;
        $pengajuan->is_print = $request->is_print;
        $pengajuan->is_accepted = $request->is_accepted;
        $pengajuan->is_deleted = $request->is_deleted;
        $pengajuan->is_completed = $request->is_completed;
        $pengajuan->save();
        return response([
            'data' => new PengajuanResource($pengajuan)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pengajuan $pengajuan)
    {
        return new PengajuanResource($pengajuan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PengajuanRequest $request, $id)
    {   
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->barcode_id = $request->barcode_id;
        $pengajuan->site_id = $request->site_id;
        $pengajuan->jenis_id = $request->jenis_id;
        $pengajuan->kategori_id = $request->kategori_id;
        $pengajuan->pekerjaan_id = $request->pekerjaan_id;
        $pengajuan->project_id = $request->project_id;
        $pengajuan->pengaju_id = $request->pengaju_id;
        $pengajuan->target_id = $request->target_id;
        $pengajuan->deskripsi = $request->deskripsi;
        $pengajuan->keterangan = $request->keterangan;
        $pengajuan->tanggal_pengajuan = $request->tanggal_pengajuan;
        $pengajuan->realisasi_pengajuan = $request->realisasi_pengajuan;
        $pengajuan->start_penawaran_to_dmt = $request->start_penawaran_to_dmt;
        $pengajuan->no_sph = $request->no_sph;
        $pengajuan->nominal_sph = $request->nominal_sph;
        $pengajuan->no_corr = $request->no_corr;
        $pengajuan->nominal_corr = $request->nominal_corr;
        $pengajuan->no_po = $request->no_po;
        $pengajuan->nominal_po = $request->nominal_po;
        $pengajuan->no_spk = $request->no_spk;
        $pengajuan->nominal_pengajuan = $request->nominal_pengajuan;
        $pengajuan->approved_at = $request->approved_at;
        $pengajuan->is_approved = $request->is_approved;
        $pengajuan->rejected_at = $request->rejected_at;
        $pengajuan->is_rejected = $request->is_rejected;
        $pengajuan->printed_at = $request->printed_at;
        $pengajuan->is_print = $request->is_print;
        $pengajuan->is_accepted = $request->is_accepted;
        $pengajuan->is_deleted = $request->is_deleted;
        $pengajuan->is_completed = $request->is_completed;
        if($pengajuan->save()) {
            return response([
                'data' => new PengajuanResource($pengajuan)
            ], Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        if($pengajuan->delete()) {
            return response([], Response::HTTP_NO_CONTENT);
        }
    }
}
