<?php

namespace App\Model;

use App\Model\Pekerjaan;
use App\Model\Pengajuan;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table    = 'project';    
    public $timestamps  = false;

    public function pekerjaan() {
        return $this->hasMany(Pekerjaan::class);
    }

    public function pengajuan() {
        return $this->hasMany(Pengajuan::class);
    }
}
