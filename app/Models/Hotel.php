<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory;
    use softDeletes;
    protected $fillable = [
        'hotel_name',
        'image',
        'city',
        'address',
        'description',
        'stars',
        'longitude',
        'latitude',
    ];
}
