<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //可以添加数据库中不存在的字段（属性）
    protected $appends=[
        'age'
    ];



    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAgeAttribute()//指定自定义age属性的值
    {
        return 8;
    }

    public function findForPassport($username)
    {
        return $this->where('email',$username)->first();//修改passport验证规则：通过字段'name'验证'username'
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function hasLiked($likeable)
    {
        return $this->likes()->where([
            'likeable_type'=>$likeable->getMorphClass(),//获取类名
            'likeable_id'=>$likeable->id
        ])->count();
    }

    public function cart()//状态为’shopping'的购物车
    {
        return Cart::firstOrCreate([
            'user_id'=>$this->id,
            'status'=>'shopping'
        ]);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function oders()
    {
        return $this->hasMany(Order::class);
    }

}
