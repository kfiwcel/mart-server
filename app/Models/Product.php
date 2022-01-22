<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $guarded=[];
    //将字段映射成对象
    protected $casts=[
        'specification'=>'object'
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeFilter(Builder $builder)
    {
        //查询过滤
        $allow_filters=[
            'category',
            'category_id',
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
