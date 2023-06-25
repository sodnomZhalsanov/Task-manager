<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCoworkerRequest;
use App\Http\Requests\CompleteTaskRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Invite;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use App\Services\RabbitMQService;
use Faker\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Contracts\Foundation\Application;

class DashboardController extends Controller
{
    public function getDashboard()
    {
        $user = Auth::user();
        $users = User::query()->select('users.*')->whereNotIn('users.id',[Auth::id()])->get();
        $tasks = ($user->tasks())->where('is_done', false)->get();

        $params = [
            'tasks' =>  $tasks,
            'user' => $user,
            'users' => $users
        ];

        return view('dashboard', $params);
    }

    public function addTask(TaskRequest $request)
    {


        $task = Task::create($request->all());


        $taskUser = TaskUser::create([
            'task_id' => $task->id,
            'user_id' => Auth::id()
        ]);

        return response()->json(['data' => $task]);



    }

    public function completeTask(CompleteTaskRequest $request): RedirectResponse
    {
        Task::where('id',$request->id)->update(['is_done' => true, 'completed_at' => date('Y-m-d')]);
        return redirect()->route('dashboard');

    }

    public function getCompletedTasks()
    {
        $user = Auth::user();
        $tasks = ($user->tasks())->where('is_done', true)->get();

        $params = [
            'tasks' =>  $tasks,
            'user' => $user
        ];

        return view('completed', $params);
    }






}
