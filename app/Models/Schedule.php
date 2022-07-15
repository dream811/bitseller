<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'trading_schedule';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'start_time',
        'end_time',
        'calculate_time',
        'created_at',
        'updated_at',
        'is_use',
        'is_del',
    ];

}
