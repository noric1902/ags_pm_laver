<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectCollection extends JsonResource
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
            'id'            => [
                'id'    => $this->id,
                'href'  => route('project.show', $this->id),
            ],
            'project'       => $this->project,
        ];
    }

    public function with($request) {
        return [
            'version'   => '1.0',
            'author'    => 'noricdev'
        ];
    }
}
