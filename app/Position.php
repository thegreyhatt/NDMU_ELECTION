<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'positions';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['position', 'order', 'is_ssg'];

    public function roles()
    {
        return $this->hasMany('App\Candidate');
    }
}
