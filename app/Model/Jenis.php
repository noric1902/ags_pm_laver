<?php

namespace App\Model;

use App\Model\Kategori;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table    = 'jenis';

    public function kategori() {
        return $this->hasMany(Kategori::class);
    }
}
