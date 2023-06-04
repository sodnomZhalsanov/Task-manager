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

    public function getEmailById(int $user_id)
    {
        $user = User::where('id', $user_id)->first();
        return $user->email;
    }

    public function getTaskById(int $task_id)
    {
        $task = Task::where('id', $task_id)->first();
        return $task;

    }
}
