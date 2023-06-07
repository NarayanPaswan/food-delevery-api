<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartFood extends Model
{
    use HasFactory;
    protected $table ="carts";
    protected $fillable = [
        'user_id',
        'food_id',
        'quantity',
        'price',
        'total_amount',
        'status'
        
    ];

    public function foodDetails() 
    {
        return $this->hasOne(Food::class,'id','food_id')->select('id','name','description','price','image');
    }
}
