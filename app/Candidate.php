<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'candidates';

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
    protected $fillable = ['profile_pic', 'id_num', 'position_id', 'college_id', 'party_list_id'];
    public static $rules = [
        'id_num' => 'required|exists:students,id_num|unique:candidates,id_num',
    ];
    public function college(){
        return $this->belongsTo('App\College');
    }
    public function position(){
        return $this->belongsTo('App\Position');
    }
    public function party_list(){
        return $this->belongsTo('App\PartyList');
    }
    public function vote(){
        return $this->belongsTo('App\Vote');
    }
    public function student(){
        return $this->belongsTo('App\Student', 'id_num');
    }

}
