@extends('layout')

@section('content')
    <div class="container" style="margin-top: 30px">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @foreach($tasks as $task)
                    <div class="card" style="margin-top: 20px; background-color: darkgray">
                        <div class="card-header">
                            <h2>{{ $task->title }}</h2>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{$task->description}}</p>
                            <h1>Deadline: {{$task->deadline}} </h1>
                            <h1>Created at: {{$task->created_at}}</h1>
                            <h1>Completed at: {{$task->completed_at}}</h1>
                            <h1>Executor: {{$user->firstname}} </h1>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>

    </div>
@endsection
