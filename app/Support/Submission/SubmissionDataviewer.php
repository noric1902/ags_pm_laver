<?php

namespace App\Support\Submission;

trait SubmissionDataviewer {

    public function scopeAdvancedFilter($query) {
        return $query;
    }

}