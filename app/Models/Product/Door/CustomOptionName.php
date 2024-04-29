<?php

namespace App\Models\Product\Door;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOptionName extends Model
{
    use HasFactory;

    protected $table = 'additional_option_names';

    protected $fillable = [
        'door_id',
        'option_name',
        'has_price',
        'price',
    ];
}
