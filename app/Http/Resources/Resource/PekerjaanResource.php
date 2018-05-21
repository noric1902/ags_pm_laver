<?php

namespace App\Http\Resources\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class PekerjaanResource extends JsonResource
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
            'pekerjaan' => $this->pekerjaan,
            'href'      => [
                'site'              => $this->site,
                'project'           => $this->project,
                // 'pengajuan_list'    => route('pengajuan.show', $this->id)
            ],
        ];
    }
}
