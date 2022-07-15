<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Trading extends Model
{
    use HasFactory;
    protected $table = 'coin_trade_list';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'coin_type',
        'cur_price',
        'cur_price1',
        'coin_quantity',
        'order_amount',
        'payout_rate',
        'state',
        'created_at',
        'updated_at',
        'is_del',
    ];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d h:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d h:i:s');
    }
}
