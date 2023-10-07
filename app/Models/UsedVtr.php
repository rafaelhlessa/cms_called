<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedVtr extends Model
{
    use HasFactory;

    protected $fillable = ['kmstart', 'kmend', 'fuel', 'date_go', 'date_back', 'cars_id', 'drivers_id'];

    public $table = 'vtr_used';

    protected $with = ['drivers', 'cars'];
    public function drivers()
    {
        return $this->hasOne('App\Models\Drivers', 'id', 'drivers_id');
    }

    public function cars()
    {
        return $this->hasOne('App\Models\Cars', 'id', 'cars_id');
    }

}
