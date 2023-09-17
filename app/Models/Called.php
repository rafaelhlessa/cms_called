<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Called extends Model
{
    use HasFactory;

    public $table = 'called';

    protected $fillable = ['id', 'glpi', 'pim', 'name', 'phone', 'service', 'problem', 'status_id', 'technic_id'];

    protected $with = ['status', 'technic', 'pmStore', 'islandStore'];

    public $timestamps = true;

    public function status()
    {
        return $this->hasOne('App\Models\Status', 'id', 'status_id');
    }

    public function technic()
    {
        return $this->hasOne('App\Models\Technic', 'id', 'technic_id');
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
