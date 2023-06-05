<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCoworkerRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use Faker\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Foundation\Application;

class DashboardController extends Controller
{
    public function getDashboard()
    {
        $user = Auth::user();
        $tasks = $user->tasks()->get();

        $params = [
            'tasks' =>  $tasks,
            'user' => $user
        ];

        return view('dashboard', $params);
    }

    public function addTask(TaskRequest $request): RedirectResponse
    {

        $task = Task::create($request->all());


        $taskUser = TaskUser::create([
            'task_id' => $task->id,
            'user_id' => Auth::id()
        ]);



        return redirect()->route('dashboard');


    }

    public function completeTask()
    {


    }

//    public function addCoworker(addCoworkerRequest $request): RedirectResponse
//    {
//
//        $task_id = $request->task_id;
//        $user = User::where('email',$request->executor_mail)->first();
//
//        $taskUser = TaskUser::create([
//            'task_id' => $task_id,
//            'user_id' => $user->id
//        ]);
//
//        return redirect()->route('dashboard');
//
//    }




}
