<?php

namespace App\Http\Resources\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class SiteResource extends JsonResource
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
            'id'            => $this->id,
            'site_id'       => $this->site_id,
            'type'          => $this->site_type,
            'name'          => $this->site_name,
            'lokasi'        => $this->lokasi,
            'description'   => $this->description,
        ];
    }
}
