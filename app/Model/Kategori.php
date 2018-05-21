<?php

namespace App\Model;

use App\Model\Jenis;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table    = 'kategori';    

    public function jenis() {
        return $this->belongsTo(Jenis::class);
    }
}
