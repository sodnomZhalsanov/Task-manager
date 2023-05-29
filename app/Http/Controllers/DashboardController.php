<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use Faker\Factory;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function getDashboard()
    {
        return view('dashboard');
    }

    public function addTask(TaskRequest $request)
    {


    }

    public function deleteTask()
    {

    }




}
