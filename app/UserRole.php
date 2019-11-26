<?php

namespace App;
App\Role;
App\User;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $guarded = [];

    public function roles(){
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function users(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
