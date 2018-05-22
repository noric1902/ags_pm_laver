<?php

namespace App\Model;

use App\User;
use App\Model\Site;
use App\Model\Jenis;
use App\Model\Project;
use App\Model\Kategori;
use App\Model\Pekerjaan;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table    = 'pengajuan';

    public function site() {
        return $this->belongsTo(Site::class);
    }

    public function jenis() {
        return $this->belongsTo(Jenis::class);
    }

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function pekerjaan() {
        return $this->belongsTo(Pekerjaan::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function pengaju() {
        return $this->belongsTo(User::class);
    }

    public function target() {
        return $this->belongsTo(User::class);
    }
}
