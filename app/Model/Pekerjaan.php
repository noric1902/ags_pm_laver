<?php

namespace App\Model;

use App\Model\Site;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    protected $table    = 'pekerjaan';

    public function site() {
        return $this->belongsTo(Site::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }
}
