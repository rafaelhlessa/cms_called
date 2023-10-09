<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = ['oil', 'active', 'factory_id', 'drivers_id', 'description', 'cars_id', 'icon', 'iconBackground', 'service', 'forecast', 'cost'];

    public $table = 'maintenance';

    protected $with = ['maint'];
    public function maint()
    {
        return $this->hasMany('App\Models\Maintenance', 'cars_id', 'id');
    }
}
