<?php

namespace App\Http\Resources\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class KategoriResource extends JsonResource
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
            'kategori'  => $this->kategori_pengajuan,
            'href'      => [
                'jenis'             => $this->jenis,
                // 'pengajuan_list'    => route('pengajuan.show', $this->id),
            ]
        ];
    }
}
