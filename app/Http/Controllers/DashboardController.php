<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function getDashboard()
    {
        $user = Auth::id();

        print_r($user);

        $tasks = Task::where('user_id', $user)->get();

        $params = [
            'user' => $user,
            'tasks' => $tasks
        ];
        return view('dashboard', $params);
    }

    public function addTask(TaskRequest $request)
    {

        $task = Task::create([
            'title' => $request->title,
            'description'=> $request->description,
            'deadline'=> $request->deadline,
            'importance'=> $request->importance,
            'color'=> $request->color
        ]);

        $user = Auth::id();
        print_r($user);

        TaskUser::create([
            'user_id' => $user,
            'task_id' => $task->id
        ]);



        return redirect()->route('dashboard');


    }

    public function deleteTask()
    {

    }

    public function addCoworker()
    {

    }




}
