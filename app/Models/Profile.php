<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo',
        'bio',
        'sub_bio',
        'email',
        'phone',
        'address',
        'working_hours',
        'instagram',
        'twitter',
        'facebook',
        'tiktok',
        'linkedin',
        'github',
        'youtube',
        'is_active',
    ];
}

