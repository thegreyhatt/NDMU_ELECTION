<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'colleges';

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
    protected $fillable = ['college', 'description'];

    public function roles()
    {
        return $this->hasMany('App\Candidate');
    }
    
}
