<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public $table = 'purchase';

    protected $fillable = ['priceu', 'amount', 'parts_id', 'buy_date', 'pricet'];

    protected $with = ['parts', 'buyParts'];

    public function parts()
    {
        return $this->hasOne('App\Models\Parts', 'id', 'parts_id');
    }

    public function buyParts()
    {
        return $this->hasMany('App\Models\Parts', 'id', 'parts_id');
    }

}
