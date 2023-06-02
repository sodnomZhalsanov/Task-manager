@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        @foreach($taskUsers as $taskUser)
            @foreach($tasks as $task)
                @if($taskUser->task_id === $task->id)
                    <div class="alert alert-info">

                        <h3>{{ $task->title }}</h3>
                        <h1>{{ $taskUser->getEmailById($taskUser->user_id) }}</h1>
                    </div>
                    <form method="post" action="{{ route('addCoworker') }}" id="{{$task->id}}">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="task_id" class="form-control" id="exampleInputPassword1" value="{{$task->id}}">
                        </div>
                        @error('task_id')
                        <span class='label-text'>{{ $message }}</span>
                        @enderror
                        <div class="mb-3">
                            <input type="text" name="executor_mail" list="executors_1" class="form-control" id="exampleInputPassword1">
                        </div>
                        <datalist id="executors_1">
                            @foreach($users as $user)
                                <option value="{{$user->email}}">
                            @endforeach
                        </datalist>
                        @error('executor_mail')
                        <span class='label-text'>{{ $message }}</span>
                        @enderror


                    </form>
                    <button type="submit" form="{{$task->id}}" class="btn btn-primary">Add executor</button>

                @endif
            @endforeach
        @endforeach


    </div>
    <div class="container-fluid">
        <form action="{{ route('addTask') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="exampleInputEmail1">
            </div>
            @error('title')
            <span class='label-text'>{{ $message }}</span>
            @enderror
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Description</label>
                <input type="text" name="description" class="form-control" id="exampleInputPassword1">
            </div>
            @error('description')
            <span class='label-text'>{{ $message }}</span>
            @enderror
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Deadline</label>
                <input type="date" name="deadline" class="form-control" id="exampleInputPassword1">
            </div>
            @error('deadline')
            <span class='label-text'>{{ $message }}</span>
            @enderror

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Color</label>
                <input type="text" name="color" class="form-control" id="exampleInputPassword1">
            </div>
            @error('color')
            <span class='label-text'>{{ $message }}</span>
            @enderror

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Importance</label>
                <input type="number" name="importance" class="form-control" id="exampleInputPassword1">
            </div>
            @error('importance')
            <span class='label-text'>{{ $message }}</span>
            @enderror

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Add executor</label>
                <input type="text" name="executor" list="executors" class="form-control" id="exampleInputPassword1">
            </div>
            @error('executor')
            <span class='label-text'>{{ $message }}</span>
            @enderror
            <datalist id="executors">
                @foreach($users as $user)
                    <option value="{{$user->email}}">
                @endforeach
            </datalist>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>

@endsection
