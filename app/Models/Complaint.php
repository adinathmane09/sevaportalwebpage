<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'subject', 'ward', 'description',
        'image_path', 'latitude', 'longitude', 'date'
    ];
}
