<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizeCode extends Model
{
    use HasFactory;

    public $fillable = [
        'product_size_code',
        'height',
        'width',
    ];

    /**
     * @var mixed
     */
    private $product_size_code;

    public function finishOptions()
    {
        return $this->belongsToMany(FinishOption::class);
    }

    public function addOnOptions()
    {
        return $this->belongsToMany(AddOnOption::class);
    }

}
