<?php

namespace App\Http\Controllers\API;

use App\Model\Project;
use App\Model\Pekerjaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectCollection;
use App\Http\Requests\API\PekerjaanRequest;
use App\Http\Resources\PekerjaanCollection;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Resource\ProjectResource;
use App\Http\Resources\Resource\PekerjaanResource;

class PekerjaanController extends Controller
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
        return PekerjaanCollection::collection(Pekerjaan::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PekerjaanRequest $request)
    {
        $pekerjaan = new Pekerjaan;
        $pekerjaan->pekerjaan = $request->pekerjaan;
        $pekerjaan->site_id = $request->site_id;
        $pekerjaan->project_id = $request->project_id;
        if($pekerjaan->save()) {
            return response([
                'data' => new PekerjaanResource($pekerjaan)
            ], Response::HTTP_CREATED);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pekerjaan $pekerjaan)
    {
        return new PekerjaanResource($pekerjaan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PekerjaanRequest $request, $id)
    {   
        $pekerjaan = Pekerjaan::findOrFail($id);
        $pekerjaan->pekerjaan = $request->pekerjaan;
        $pekerjaan->site_id = $request->site_id;
        $pekerjaan->project_id = $request->project_id;
        if($pekerjaan->save()) {
            return response([
                'data' => new PekerjaanResource($pekerjaan)
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
        $pekerjaan = Pekerjaan::findOrFail($id);
        if($pekerjaan->delete()) {
            return response([], Response::HTTP_NO_CONTENT);
        }
    }
}
