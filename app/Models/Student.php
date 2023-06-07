<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table ="students";
    protected $fillable = [
        'name',
        'image',
        'mobile_no',
        'date_of_birth',
        'gender',
        'company',
        'country_id',
        'country_name',
        'state_id',
        'state_name',
        'city_id',
        'city_name',
        'marital_status',
        'user_id'
    ];
}
