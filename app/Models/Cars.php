<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    protected $fillable = ['plate', 'brandmodel', 'km', 'fuel', 'used', 'qrcode', 'drivers_id', 'kmoil', 'operation'];

    public $table = 'cars';

    protected $with = ['carsUsed', 'driver', 'maint'];

    public function carsUsed()
    {
        return $this->belongsTo('App\Models\UsedVtr', 'cars_id', 'id');
    }

    public function driver()
    {
        return $this->belongsTo('App\Models\Drivers', 'drivers_id', 'id');
    }

    public function maint()
    {
        return $this->belongsTo('App\Models\Maintenance', 'id', 'cars_id');
    }

}
