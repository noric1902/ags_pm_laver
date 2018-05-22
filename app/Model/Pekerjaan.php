<?php

namespace App\Model;

use App\Model\Site;
use App\Model\Pengajuan;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    protected $table    = 'pekerjaan';
    public $timestamps  = false;

    public function site() {
        return $this->belongsTo(Site::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function pengajuan() {
        return $this->hasMany(Pengajuan::class);
    }
}
