<?php

namespace App\Http\Controllers\API;

use App\Model\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\SiteRequest;
use App\Http\Resources\SiteCollection;
use App\Http\Resources\Resource\SiteResource;
use Symfony\Component\HttpFoundation\Response;

class SiteController extends Controller
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
        return SiteCollection::collection(Site::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiteRequest $request)
    {
        $site = new Site;
        $site->site_id = $request->site_id;
        $site->site_type = $request->site_type;
        $site->site_name = $request->site_name;
        $site->lokasi = $request->lokasi;
        $site->description = $reqeuest->description;
        if($site->save()) {
            return response([
                'data' => new SiteResource($site)
            ], Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        return new SiteResource($site);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SiteRequest $request, $id)
    {
        $site = Site::findOrFail($id);
        $site->site_id = $request->site_id;
        $site->site_type = $request->site_type;
        $site->site_name = $request->site_name;
        $site->lokasi = $request->lokasi;
        $site->description = $reqeuest->description;
        if($site->save()) {
            return response([
                'data' => new SiteResource($site)
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
        $site = Site::findOrFail($id);
        if($site->delete()) {
            return response([], Response::HTTP_NO_CONTENT);
        }
    }
}
