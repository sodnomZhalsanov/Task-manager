<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskUser extends Pivot
{
    protected $table = 'task_users';

    public $incrementing = true;

    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_id'
    ];


}
