<?php

namespace App\Model;

use App\Model\Pekerjaan;
use App\Model\Pengajuan;
use App\Support\Site\SiteDataviewer;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use SiteDataviewer;
    
    protected $table    = 'site';    
    public $timestamps  = false;

    public function pekerjaan() {
        return $this->hasMany(Pekerjaan::class);
    }

    public function pengajuan() {
        return $this->hasMany(Pengajuan::class);
    }
    
    protected $allowedFilters = [
        'id', 'site_id', 'site_name', 'lokasi'
    ];
    
    protected $orderable = [
        'id', 'site_id', 'site_name', 'lokasi'
    ];

}
