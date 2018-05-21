<?php

namespace App\Model;

use App\Model\Pekerjaan;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table    = 'site';    

    public function pekerjaan() {
        return $this->hasMany(Pekerjaan::class);
    }
}
