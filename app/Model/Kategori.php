<?php

namespace App\Model;

use App\Model\Jenis;
use App\Model\Pengajuan;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table    = 'kategori';  
    public $timestamps  = false;  

    public function jenis() {
        return $this->belongsTo(Jenis::class);
    }
    
    public function pengajuan() {
        return $this->hasMany(Pengajuan::class);
    }
}
