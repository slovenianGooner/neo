<?php

namespace App\Models\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Specification extends Model
{
    protected $table = 'product_specifications';

    protected $fillable = [
        'product_id',
        'type_id',
        'name',
        'value',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(SpecificationType::class, 'type_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
