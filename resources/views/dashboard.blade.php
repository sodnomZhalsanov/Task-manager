@extends('layout')

@section('content')
    <div class="container-fluid">
        <p>Добро пожаловать <b>{{ Auth::user()->firstname }}</b></p>
        <form id="logout-form" action="{{ route('signOut') }}" method="POST">
            @csrf
            <button type="submit" form="logout-form" class="btn btn-danger">Выйти</button>
        </form>
    </div>

    <div class="container" style="margin-top: 30px" id="tasks">
        <div class="row justify-content-center">
            <div class="col-lg-8" id="tasks">
                @foreach($tasks as $task)
                    <div class="card" style="margin-top: 20px; background-color: {{$task->color}}">
                        <div class="card-header">
                            <h2>{{ $task->title }}</h2>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{$task->description}}</p>
                            <h1>Deadline: {{$task->deadline}} </h1>
                            <h1>Executor: {{$user->firstname}} </h1>
                            <h1>Level of urgency: {{$task->importance}}</h1>
                            <ul>
                                @foreach($task->users()->get() as $executor)
                                    <li>{{ $executor->email }} </li>
                                @endforeach
                            </ul>

                            <form method="post" action="{{ route('addCoworker')  }}" id="{{ $task->id }}toAdd">
                                @csrf
                                <label for="exampleInput" class="form-label">Executor`s Email</label>
                                <input type="text" list="datalistOptions" name="executor_mail" id="exampleInput" placeholder="Type to search...">
                                <datalist id="datalistOptions">
                                    @foreach($users as $option)
                                        <option value="{{ $option->email }}"></option>
                                    @endforeach
                                </datalist>
                                @error('executor_mail')
                                <span class='label-text'>{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="task_id" value="{{$task->id}}">
                            </form>
                            <button type="submit" form="{{ $task->id }}toAdd">Add executor</button>

                            <form method="post" action="{{ route('completeTask')  }}" id="{{ $task->id }}toComplete">
                                @csrf
                                <input type="hidden" name="id" value="{{$task->id}}">
                            </form>

                            <button type="submit" form="{{ $task->id }}toComplete">Complete Task</button>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>

    </div>
    <div>
        <a href="{{route('completeTask')}}" class="button">Completed tasks</a>
    </div>
    <div class="container-fluid" style="margin-top: 30px">
        <form id="addTask" action="{{route('addTask')}}" method="post">
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
                <input type="color" name="color" value="#ffffff" class="form-control" id="exampleInputPassword1">
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


            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
    <script>
        $(document).ready(function () {
            $('#addTask').submit(function (e) {

                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function (data) {
                        location.reload();
                    }
                });
            });
        });
    </script>

@endsection
