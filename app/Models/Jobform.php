<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobform extends Model
{
    use HasFactory;
    protected $table ="jobforms";
    protected $fillable = [
        'photo',
        'resume',
        'name',
        'contact_number',
        'date_of_birth',
        'address',
        'postal_code',
        'country_id',
        'country_name',
        'state_id',
        'state_name',
        'city_id',
        'city_name',
        'gender',
        'marital_status',
        'work_experience',
        'company_name',
        'designation',
        'duration_from',
        'duration_upto',
        'user_id',
    ];
}
