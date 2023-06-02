<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCoworkerRequest;
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

        $params = [
            'tasks' => Task::all(),
            'users' => User::all(),
            'taskUsers' => TaskUser::all()
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

        $user = User::where('email',$request->executor)->first();


        $taskUser = TaskUser::create([
            'task_id' => $task->id,
            'user_id' => $user->id
        ]);



        return redirect()->route('dashboard');


    }

    public function deleteTask()
    {

    }

    public function addCoworker(addCoworkerRequest $request)
    {
        print_r($request->task_id);
        print_r($request->executor);
        echo "test"; die;
        $task_id = $request->task_id;
        $user = User::where('email',$request->executor)->first();

        $taskUser = TaskUser::create([
            'task_id' => $task_id,
            'user_id' => $user->id
        ]);

    }




}
