<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Str;

trait WithFilter {

    public $filter = [
        'filter' => '',
        'date_from' => '',
        'date_to' => '',
        'date' => '',

        'date_from_disabled' => false,
        'date_to_disabled' => false,
        'date_disabled' => false,
    ];

    public function withFilter($data, $column = 'created_at') 
    {
        if ($this->filter['filter'] == 'today') {
            return $data->whereDate($column, $this->today());
        } elseif ($this->filter['filter'] == 'yesterday') {
            return $data->whereDate($column, $this->yesterday());
        } elseif ($this->filter['filter'] == 'this_week') {
            return $data->whereBetween($column, $this->thisWeek());
        } elseif ($this->filter['filter'] == 'last_week') {
            return $data->whereBetween($column, $this->lastWeek());
        } elseif ($this->filter['filter'] == 'this_month') {
            return $data->whereMonth($column, $this->thisMonth());
        } elseif ($this->filter['filter'] == 'last_month') {
            return $data->whereMonth($column, $this->lastMonth());
        } elseif ($this->filter['filter'] == 'this_year') {
            return $data->whereYear($column, $this->thisYear());
        } elseif ($this->filter['filter'] == 'last_year') {
            return $data->whereYear($column, $this->lastYear());
        } elseif ($this->filter['filter'] == 'date_range' && $this->dateRangeHasValue()) {
            return $data->whereBetween($column, $this->dateRange()); 
        } elseif ($this->filter['filter'] == 'date_single' && $this->dateSingleHasValue()) {
            return $data->whereDate($column, $this->dateSingle()); 
        }
    }


    public function filterCategory()
    {
        return Str::replace('_', ' ', Str::title($this->filter['filter']));
    }


    public function dateRangeHasValue()
    {
        return !empty($this->filter['date_from']) && !empty($this->filter['date_to'])
            ? true
            : false;
    }

    public function dateSingleHasValue()
    {
        return !empty($this->filter['date'])
            ? true
            : false;
    }




    public function dateRange()
    {
        return [$this->filter['date_from'], $this->filter['date_to']];
    }

    public function dateSingle()
    {
        return $this->filter['date'];
    }





    private function setDefaultFilter($default_filter = 'this_year') 
    {
        return $this->filter['filter'] = $default_filter;
    }
    

    private function today()
    {
        return today();
    }

    private function yesterday()
    {
        return Carbon::yesterday();
    }

    private function thisWeek()
    {
        return [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek() 
        ];
    }

    private function lastWeek()
    {
        return [
            Carbon::now()->subWeek()->startOfWeek(), 
            Carbon::now()->subWeek()->endOfWeek()
        ];
    }

    private function thisMonth()
    {
        return [
            Carbon::now()->startOfMonth(), 
            Carbon::now()->endOfMonth()
        ];
    }

    private function lastMonth()
    {
        return [
            Carbon::now()->subMonth()->startOfMonth(), 
            Carbon::now()->subMonth()->endOfMonth()
        ];
    }

    private function thisYear()
    {
        return [
            Carbon::now()->startOfYear(), 
            Carbon::now()->endOfYear()
        ];
    }

    private function lastYear()
    {
        return [
            Carbon::now()->subYear()->startOfYear(), 
            Carbon::now()->subYear()->endOfYear()
        ];
    }

}