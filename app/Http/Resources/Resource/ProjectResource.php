<?php

namespace App\Http\Resources\Resource;

use App\Http\Resources\PekerjaanCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'project'   => $this->project,
            'href'      => [
            //     'pengajuan_list'    => route('pengajuan.show', $this->id),
                'pekerjaan' => PekerjaanCollection::collection($this->pekerjaan),
            ],
        ];
    }
}
