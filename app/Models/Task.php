<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $attributes = [
        'is_done' => false,
        'completed_at' => null
    ];

    protected $fillable = [
        'title',
        'description',
        'started_at',
        'deadline',
        'importance',
        'color'
    ];
}
