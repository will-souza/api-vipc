<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $appends = ['total', 'payment_method'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getTotalAttribute()
    {
        return $this->products()->sum(DB::raw('quantity * price'));
    }

    public function getPaymentMethodAttribute()
    {
        return PaymentMethod::find($this->payment_method_id)->name;
    }

}
