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
        'is_check',
        'created_at',
        'updated_at',
        'is_del',
    ];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function coin()
    {
        return $this->belongsTo(Coin::class, 'coin_type', 'key');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
