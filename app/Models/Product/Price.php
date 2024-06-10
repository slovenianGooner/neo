<?php

namespace App\Models\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    protected $table = 'product_prices';

    protected $fillable = [
        'product_id',
        'price',
        'currency',
        'valid_from',
        'valid_to',
        'note',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'valid_from' => 'datetime',
        'valid_to' => 'datetime',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getFormattedAttribute(): string
    {
        return number_format($this->price, 2) . ' ' . $this->currency;
    }
}
