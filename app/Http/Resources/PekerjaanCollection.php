<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PekerjaanCollection extends JsonResource
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
            'id'            => $this->id,
            'pekerjaan'     => $this->pekerjaan,
            'project'       => route('project.show', $this->project_id),
        ];
    }
}
