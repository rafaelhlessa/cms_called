<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCalled extends Model
{
    use HasFactory;

    public $table = 'report';

    protected $fillable = ['called_id', 'solution', 'tech_report','technic_id'];
}
