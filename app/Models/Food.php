<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CartFood;

class Food extends Model
{
    use HasFactory;
    protected $table ="foods";
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'star',
        'image',
        'location',
        'status',
        'slug'
    ];

   
    
}
