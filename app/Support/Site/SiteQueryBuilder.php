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
        $this->{camel_case($filter['operator'])}($filter, $query);
    }

    public function searchAny($filter, $query) {
        return $query->where('id', 'like', '%' . $filter['any'] . '%')
                     ->orWhere('site_id', 'like', '%' . $filter['any'] . '%')
                     ->orWhere('site_type', 'like', '%' . $filter['any'] . '%')
                     ->orWhere('site_name', 'like', '%' . $filter['any'] . '%')
                     ->orWhere('lokasi', 'like', '%' . $filter['any'] . '%')
                     ->orWhere('description', 'like', '%' . $filter['any'] . '%')
                     ;
    }

    public function contains($filter, $query) {
        $q = $query->where(
                        ($filter['column'] != 'all' ? $filter['column'] : 'site_id'), 
                        'like', 
                        '%'. (isset($filter['query_1']) ? $filter['query_1'] : $filter['any']) .'%'
                    );
        if(isset($filter['any']) && $filter['column'] == 'all') {
            $q = $query ->orWhere('site_type', 'like', '%' . $filter['any'] . '%')
                        ->orWhere('site_name', 'like', '%' . $filter['any'] . '%')
                        ->orWhere('lokasi', 'like', '%' . $filter['any'] . '%')
                        ->orWhere('description', 'like', '%' . $filter['any'] . '%');
        }
        return $q;
    }

    public function equalTo($filter, $query) {
        $q = $query->where(
                        ($filter['column'] != 'all' ? $filter['column'] : 'site_id'), 
                        '=', 
                        (isset($filter['query_1']) ? $filter['query_1'] : $filter['any'])
                    );
        if(isset($filter['any']) && $filter['column'] == 'all') {
            $q = $query ->orWhere('site_type', '=', $filter['any'])
                        ->orWhere('site_name', '=', $filter['any'])
                        ->orWhere('lokasi', '=', $filter['any'])
                        ->orWhere('description', '=', $filter['any'])
                        ;
        }
        return $q;
    }

}