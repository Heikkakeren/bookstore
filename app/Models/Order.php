<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_code',
        'total_price',
        'payment_method',
        'status',
        'shipping_address',
    ];

    protected function casts(): array
    {
        return [
            'total_price' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'warning',
            'processing' => 'info',
            'completed' => 'success',
            'cancelled' => 'danger',
            default => 'secondary',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu',
            'processing' => 'Diproses',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => ucfirst($this->status),
        };
    }

    public function getPaymentMethodLabelAttribute(): string
    {
        return match (strtolower($this->payment_method)) {
            'qris' => 'QRIS',
            'gopay' => 'GoPay',
            'transfer' => 'Transfer Bank',
            'cod' => 'QRIS',
            'delivery' => 'Transfer Bank',
            default => strtoupper($this->payment_method),
        };
    }

    public function getPaymentMethodBadgeAttribute(): string
    {
        return match (strtolower($this->payment_method)) {
            'qris' => 'bg-success text-white',
            'gopay' => 'bg-primary text-white',
            'transfer' => 'bg-warning text-dark',
            default => 'bg-secondary text-white',
        };
    }
}
