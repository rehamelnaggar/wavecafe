<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'special',
        'published',
        'image'
     ];

    public function category()
    {
        return $this->belongsTo(DrinkCategory::class, 'category_id');
    }
}
