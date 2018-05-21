<?php

namespace App\Http\Resources\Resource;

use App\Http\Resources\KategoriCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class JenisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'        => $this->id,
            'jenis'     => $this->jenis_pengajuan,
            'href'      => [
                'kategori'  => KategoriCollection::collection($this->kategori)
            ]
        ];
    }
}
