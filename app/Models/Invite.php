<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;
    protected $attributes = [
        'is_accepted' => false,
    ];

    protected $fillable = [
        'owner_id',
        'user_id',
        'task_id',
        'is_accepted',
        'token'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
