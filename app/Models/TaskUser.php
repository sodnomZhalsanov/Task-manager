<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskUser extends Model
{
    protected $table = 'task_users';

    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_id'
    ];
}
