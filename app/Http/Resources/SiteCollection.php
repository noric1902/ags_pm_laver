<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SiteCollection extends JsonResource
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
                'href'  => route('site.show', $this->id),
            ],
            'site_id'       => $this->site_id,
            'type'          => $this->site_type,
            'name'          => $this->site_name,
            'lokasi'        => $this->lokasi,
            'description'   => $this->description,
        ];
    }
}