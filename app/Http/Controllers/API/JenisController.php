<?php

namespace App\Http\Controllers\API;

use App\Model\Jenis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\JenisRequest;
use App\Http\Resources\JenisCollection;
use App\Http\Resources\Resource\JenisResource;
use Symfony\Component\HttpFoundation\Response;

class JenisController extends Controller
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
        return JenisCollection::collection(Jenis::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisRequest $request)
    {
        $jenis = new Jenis;
        $jenis->jenis_pengajuan = $request->jenis_pengajuan;
        if($jenis->save()) {
            return response([
                'data'  => new JenisResource($jenis)
            ], Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Jenis $jeni)
    {
        return new JenisResource($jeni);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JenisRequest $request, $id)
    {   
        $jenis = Jenis::findOrFail($id);
        $jenis->jenis_pengajuan = $request->jenis_pengajuan;
        if($jenis->save()) {
            return response([
                'data'  => new JenisResource($jenis)
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
        $jenis = Jenis::findOrFail($id);
        if ($jenis->delete()) {
            return response([], Response::HTTP_NO_CONTENT);
        }
    }
}
