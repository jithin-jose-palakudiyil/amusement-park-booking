<?php

namespace Modules\Backend\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BackendUsers extends Authenticatable
{
    use SoftDeletes;
    protected $table = "backend_users";
    protected $fillable = ['name','email','password','status'];
    protected $hidden = ['password']; 
    protected $dates = ['deleted_at'];
}
