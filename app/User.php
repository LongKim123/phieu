<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class User extends Authenticatable
{
    use Notifiable,
    SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }
    public function role_user()
    {
        return $this->hasMany(RoleUser::class, 'role_id');
    }
    public function getCreatedAtAttribute($value){
         return Carbon::parse($value)->format('d F Y');
    }


    //khai báo Accessors  lọc dữ liệu trước khi controller lấy ra
    //  public function getNameAttribute($value)
    // {
    //     return strToLower($value);
    // }


    //khai báo Mutators đảm bảo rằng khi dữ liệu đi vào CSDL sẽ được lọc qua hàm của Mutators

    public function setNameAttribute($value)
    {
         $this->attributes['name'] = ucwords($value);
    }


}
