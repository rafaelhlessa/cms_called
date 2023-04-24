<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PMStore extends Model
{
    use HasFactory;

    public $table = 'pm_stores';

    protected $fillable = ['amount', 'parts_id'];

    public function partsPm()
    {
        return $this->hasOne('App\Models\Parts', 'id', 'parts_id');
    }
}
