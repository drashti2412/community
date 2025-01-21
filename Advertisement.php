<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'mem_email',
        'title',
        'description',
        'image',
        'start_date',
        'end_date',
        'location',
        'size',
        'cost',
    ];
}
