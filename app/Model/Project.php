<?php

namespace App\Model;

use App\Model\Pekerjaan;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table    = 'project';    

    public function pekerjaan() {
        return $this->hasMany(Pekerjaan::class);
    }
}
