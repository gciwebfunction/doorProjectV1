<?php

namespace App\Models\Product\Door;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Door extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'door_type_id',
        'category_id',
        'panel_count',
        'main_image',
        'sort_order'
    ];

    public function isGliding(): bool
    {
        if ($this->category() !== null) {
            $catName = strtolower($this->category->category_name);
            return str_contains($catName, 'glid');
        }

        return false;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function doorNames()
    {
        return $this->hasMany(DoorName::class);
    }

    public function doorType()
    {
        return $this->belongsTo(DoorType::class);
    }

    public function doorFrames()
    {
        return $this->hasMany(DoorFrame::class);
    }

    public function doorHandlings()
    {
        return $this->hasMany(DoorHandling::class);
    }

    public function doorMeasurements()
    {
        return $this->hasMany(DoorMeasurement::class);
    }

    public function interiorColors()
    {
        return $this->hasMany(InteriorColor::class);
    }

    public function additionalOptions()
    {
        return $this->hasMany(AdditionalOption::class);
    }

    public function customOptions()
    {
        return $this->hasMany(CustomOptionName::class);
    }
}
