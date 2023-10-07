<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    protected $fillable = ['plate', 'brandmodel', 'km', 'fuel', 'used', 'qrcode', 'drivers_id'];

    public $table = 'cars';

    protected $with = ['carsUsed', 'driver'];

    public function carsUsed()
    {
        return $this->belongsTo('App\Models\UsedVtr', 'cars_id', 'id');
    }

    public function driver()
    {
        return $this->belongsTo('App\Models\Drivers', 'drivers_id', 'id');
    }
}
