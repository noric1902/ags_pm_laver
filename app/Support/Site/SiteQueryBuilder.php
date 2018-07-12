<?php

namespace App\Support\Site;

class SiteQueryBuilder {

    public function apply($query, $data) {
        if (isset($data['f'])) {
            foreach($data['f'] as $filter) {
                $filter['match'] = isset($data['filter_match']) ? $ $data['filter_match'] : 'and';
                $this->makeFilter($query, $filter);
            }
        }

        return $query;
    }

    protected function makeFilter($query, $filter) {
        $this->{
            camel_case($filter['operator'])
        }($filter, $query);
    }

    public function contains($filter, $query) {
        return $query->where($filter['column'], 'like', '%'. $filter['query_1'] .'%', $filter['match']);
    }

    public function equalTo($filter, $query) {
        return $query->where($filter['column'], '=', $filter['query_1'], $filter['match']);
    }

}