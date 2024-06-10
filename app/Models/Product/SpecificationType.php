<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class SpecificationType extends Model
{
    protected $table = 'product_specification_types';

    protected $fillable = [
        'type',
        'name',
        'options',
    ];

    protected $casts = [
        'options' => 'array',
    ];
}
