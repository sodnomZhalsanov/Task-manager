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
    public function __construct(RabbitMQService $MQService)
    {
        $this->MQService = $MQService;
    }
    public function getDashboard()
    {
        $user = Auth::user();
        $tasks = ($user->tasks())->where('is_done', false)->get();

        $params = [
            'tasks' =>  $tasks,
            'user' => $user
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

    public function addCoworker(AddCoworkerRequest $request): RedirectResponse
    {
        $task_id = $request->task_id;

        $user = User::where('email',$request->executor_mail)->first();


        if(!$user){
            return back()->withInput()->withErrors([
                'executor_mail'=> "Couldn't find a user by email"
            ]);
        }

        do {
            //generate a random string using Laravel's str_random helper
            $token = Str::random(16);
        } //check if the token already exists and if it does, try again
        while (Invite::where('token', $token)->first());

        //create a new invite record
        $invite = Invite::create([
            'owner_id' => Auth::id(),
            'user_id' => $user->id,
            'task_id' => $task_id,
            'token' => $token
        ]);

        $message = $user->email.",".$invite->token;

        $this->MQService->publish($message, 'invite');

        return redirect()->route('dashboard');

    }

    public function accept($token)
    {
        if (!$invite = Invite::where('token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }

        $invite->update(['is_accepted' => true ]);

        TaskUser::create([
            'task_id' => $invite->task_id,
            'user_id' => $invite->user_id
        ]);

        return redirect()->route('dashboard');

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
