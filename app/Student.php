<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id_num';
    public function roles()
    {
        return $this->hasOne('App\Candidate');
    }
}
