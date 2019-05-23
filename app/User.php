<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password'];
}
