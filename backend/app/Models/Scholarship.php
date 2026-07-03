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
        'university',
        'domain',
        'level',
        'deadline',
        'description',
        'funding_type',
        'amount',
        'currency',
        'benefits',
        'days_remaining',
        'requirements',
        'min_average',
        'required_english_level',
        'languages',
        'image',
        'link',
        'source'
    ];

    protected $casts = [
        'deadline' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'languages' => 'array', 
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
};
