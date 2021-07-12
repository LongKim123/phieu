<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $guarded=[];
    protected $fillable=['name','display_name'];
    public function role_user()
	{
	    return $this->hasMany(RoleUser::class, 'role_id');
	}
}
