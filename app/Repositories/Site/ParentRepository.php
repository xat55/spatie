<?php

namespace App\Repositories\Site;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;
use Config;


abstract class ParentRepository
{
    protected $model = false;
    
    public function allQuery($search = [], $fieldOrderBy = 'id', $orderDirection = 'ASC', $skip = null, $limit = null)
    {
        $builder = $this->model->newQuery();

        if (count($search)) {
            foreach($search as $key => $value) {            
                $builder->where($key, $value);
            }
        }
        
        if (isset($fieldOrderBy)) {
            $builder->orderBy($fieldOrderBy, $orderDirection);
        }

        if (isset($skip)) {
            $builder->skip($skip);
        }

        if (isset($limit)) {
            $builder->limit($limit);
        }

        return $builder;
    }

    public function all($search = [], $fieldOrderBy = 'id', $orderDirection = 'ASC', $skip = null, $limit = null, $columns = ['*'])
    {
        $builder = $this->allQuery($search, $fieldOrderBy, $orderDirection, $skip, $limit);

        return $builder->get($columns);
    }
    
    public function get($search = '*', $limit = null)
    {
        $builder = $this->model->select($search);
            
        if (isset($limit)) {
            $builder->limit($limit);
        }

        return $builder->get();
    }
    
    public function find($id)
    {
        $builder = $this->model->find($id);

        return $builder;
    }    
    
    public function paginate($perPage, $columns = ['*'])
    {
        $builder = $this->allQuery();
    
        return $builder->paginate($perPage, $columns);
    }
    
    public function getLike($field, $search, $perPage)
    {
        $builder = $this->model->newQuery();        
        $builder->where($field, 'LIKE', "%{$search}%");
        
        return $builder->paginate($perPage);
    }
}
