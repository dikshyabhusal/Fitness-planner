<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'student_id',
        'total_amount',
        'status',
        'payment_at',
        'payment_method',
        'delivery_address',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'payment_at' => 'datetime', // this fixes the format() error
    ];

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
