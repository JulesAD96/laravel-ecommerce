<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /*
    * Users with current role
    */ 
    public function users()
    {
        return $this
            ->belongsToMany('App\User')
            ->withTimestamps();
    }
}
