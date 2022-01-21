<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeFilter(Builder $builder)
    {
        //查询过滤
        $allow_filters=[
            'category',
            'name',
            'price',
            'brand'
        ];
        $filters=request()->query();
        foreach ($filters as $filter_filed => $filter_value){
            if(in_array($filter_filed,$allow_filters,true)){
                $builder->where($filter_filed,$filter_value);
            }

        }
    }
}
