<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        'name',
        'quantity'
    ];

    public function setQuantityAttribute($value)
    {
        $currentValue = data_get($this->attributes, 'quantity');
        data_set($this->attributes, 'quantity', $currentValue + $value);
    }
}
