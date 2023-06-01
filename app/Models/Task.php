<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $attributes = [
        'is_done' => false,
        'completed_at' => '1976-01-01'
    ];

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'importance',
        'color'
    ];
}
