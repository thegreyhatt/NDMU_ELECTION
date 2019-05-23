<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartyList extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'party_lists';

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
    protected $fillable = ['partylist', 'description', 'college'];

    public function roles()
    {
        return $this->hasMany('App\Candidate');
    }
}
