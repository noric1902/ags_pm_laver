<?php

namespace App\Support\Site;

use App\Support\Site\SiteQueryBuilder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait SiteDataviewer {

    public function scopeAdvancedFilter($query) {
        return $this->process($query, request()->all())
                ->orderBy(
                    request('order_column', 'id'), request('order_direction', 'desc')
                )
                ->paginate(request('limit', 10));
    }

    public function process($query, $data) {
        $rules = [
            'order_column' => 'sometimes|required|in:'.$this->orderableColumns(),
            'order_direction' => 'sometimes|required|in:asc,desc',
            'limit' => 'sometimes|required|integer|min:1',
            'filter_match' => 'sometimes|required|in:and,or',
            'f' => 'sometimes|array',
            'any' => 'sometimes|required_with:f',
            'f.*.column' => 'in:'.$this->allowedColumns(),
            'f.*.operator' => 'in:'.$this->allowedOperators(),
            'f.*.query_1' => '',
        ];

        $v = Validator::make($data, $rules);

        if ($v->fails()) {
            return dd($v->messages()->all());

            throw new ValidationException;
        }
        
        return (new SiteQueryBuilder)->apply($query, $data);
    }

    protected function allowedColumns() {
        return implode(',', $this->allowedFilters);
    }

    protected function orderableColumns() {
        return implode(',', $this->orderable);
    }

    protected function allowedOperators() {
        return implode(',', [
            'equal_to',
            'contains'
        ]);
    }

}