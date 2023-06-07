<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    use HasFactory;
    protected $table ="tasks";
    protected $fillable = [
        'name',
        'description',
        'status',
        'date',
        'time'
       
    ];
}
