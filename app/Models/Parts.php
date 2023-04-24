<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parts extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'amount', 'equipament_id', 'parts_type_id'];

    public $table = 'parts';

    protected $with = ['equipament', 'partType', 'pmStore', 'islandStore'];

    public function equipament()
    {
        return $this->hasOne('App\Models\Equipament', 'id', 'equipament_id');
    }

    public function partType()
    {
        return $this->hasOne('App\Models\PartsType', 'id', 'parts_type_id');
    }

    public function pmStore()
    {
        return $this->hasOne('App\Models\PMStore', 'parts_id', 'id');
    }

    public function islandStore()
    {
        return $this->hasOne('App\Models\IslandStore', 'parts_id', 'id');
    }
}
