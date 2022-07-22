<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'approved_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    protected $dates = ['approved_at'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function() {
            cache()->forget('orders');
        });
        static::deleting(function() {
            cache()->forget('orders');
        });
    }
}
