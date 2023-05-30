<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Faker\Factory;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function getDashboard()
    {
        $tasks = Task::all();

        $params = [
            'tasks' => $tasks
        ];
        return view('dashboard', $params);
    }

    public function addTask(TaskRequest $request)
    {
        $task = Task::create([
            'title' => $request->title,
            'description'=> $request->description,
            'started_at'=> $request->started_at,
            'deadline'=> $request->deadline,
            'importance'=> $request->importance,
            'color'=> $request->color
        ]);

        return redirect()->route('dashboard');


    }

    public function deleteTask()
    {

    }




}
