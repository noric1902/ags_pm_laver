<?php

namespace App\Http\Controllers\API;

use App\Model\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\KategoriRequest;
use App\Http\Resources\KategoriCollection;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Resource\KategoriResource;

class KategoriController extends Controller
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
        return KategoriCollection::collection(Kategori::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriRequest $request)
    {
        $kategori = new Kategori;
        $kategori->kategori_pengajuan = $request->kategori_pengajuan;
        $kategori->jenis_id = $request->jenis_id;
        if($kategori->save()) {
            return response([
                'data' => new KategoriResource($kategori)
            ], Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        return new KategoriResource($kategori);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriRequest $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->kategori_pengajuan = $request->kategori_pengajuan;
        $kategori->jenis_id = $request->jenis_id;
        if($kategori->save()) {
            return response([
                'data' => new KategoriResource($kategori)
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
        $kategori = Kategori::findOrFail($id);
        if($kategori->delete()) {
            return response([], Response::HTTP_NO_CONTENT);
        }
    }
}
