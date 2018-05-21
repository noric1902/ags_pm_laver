<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KategoriCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'        => [
                'id'    => $this->id,
                'href'  => route('kategori.show', $this->id),
            ],
            'kategori'  => $this->kategori_pengajuan,
        ];
    }
}
