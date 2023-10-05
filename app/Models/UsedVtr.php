<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedVtr extends Model
{
    use HasFactory;

    protected $fillable = ['kmstart', 'kmend', 'fuel', 'date_go', 'date_back', 'cars_id', 'drivers_id'];

    public $table = 'vtr_used';
}
