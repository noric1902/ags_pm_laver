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
            'id'            => $this->id,
            'site_id'       => $this->site_id,
            'site_type'          => $this->site_type,
            'site_name'          => $this->site_name,
            'lokasi'        => $this->lokasi,
            'description'   => $this->description,
        ];
    }
}
