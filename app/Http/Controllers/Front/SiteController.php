<?php

namespace App\Http\Controllers\Front;

use App\Model\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Resource\SiteResource;
use Symfony\Component\HttpFoundation\Response;

class SiteController extends Controller
{
    
    public function deleteSelected(Request $request) {
        $arrayID = $request->id;

        try {
            Site::whereIn('id', $arrayID)->delete();
            return response([
                'success' => 'true'
            ], Response::HTTP_OK);
        }
        catch(Exception $err) {
            return response([
                'err' => 'true',
                'message' => $err->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function doFilter(Request $request) {
        try {
            $site = Site::where('site_id', 'like', '%' . $request->site_id . '%')->get();
            return response([
                'data' => $site
            ], Response::HTTP_OK);
        }
        catch(Exception $err) {
            return response([
                'err' => 'true',
                'message' => $err->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
