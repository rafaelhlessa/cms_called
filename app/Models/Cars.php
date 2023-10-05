<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    protected $fillable = ['plate', 'brandmodel', 'km', 'fuel', 'used', 'qrcode'];

    public $table = 'cars';
}
