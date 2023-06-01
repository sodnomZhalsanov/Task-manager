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

        $taskUsers = TaskUser::where('user_id', $user)->get();

        $tasks = Task::all();
        $arr = [];
        foreach ($taskUsers as $el){
            foreach ($tasks as $task){
                if ($task->id === $el->task_id){
                    $arr[] = $task;
                }
            }
        }

        $params = [
            'tasks' => $arr
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
