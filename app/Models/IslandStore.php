<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IslandStore extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'parts_id'];

    public function partsIsland()
    {
        return $this->hasOne('App\Models\Parts', 'id', 'parts_id');
    }
}
