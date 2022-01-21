<?php

namespace App\Models;

use Composer\IO\BufferIO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded=[];
    use HasFactory;

    public function children()
    {
        return $this->hasMany(self::class,'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(self::class,'parent_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }


    public function scopeRoots(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }

    public function scopeSort(Builder $builder,$direction='asc')
    {
        $builder->orderBy('order',$direction);
    }


}
