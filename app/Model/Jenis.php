<?php

namespace App\Model;

use App\Model\Kategori;
use App\Model\Pengajuan;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table    = 'jenis';
    public $timestamps  = false;

    public function kategori() {
        return $this->hasMany(Kategori::class);
    }

    public function pengajuan() {
        return $this->hasMany(Pengajuan::class);
    }
}
