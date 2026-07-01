<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Scholarship extends Model
{
    use HasFactory;
    protected $table = 'scholarships';
    protected $fillable = [
        'title',
        'country',
        'region',
        'university',
        'domain',
        'deadline',
        'description',
        'is_funded',
        'amount',
        'benefits',
        'days_remaining',
        'requirements',
        'image',
        'link',
        'source'
    ];

    protected $casts = [
        'deadline' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
};
