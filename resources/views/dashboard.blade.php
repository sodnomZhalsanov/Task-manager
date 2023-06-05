@extends('layout')

@section('content')

    <div class="container" style="margin-top: 30px">
        <div class="row justify-content-center">
            <div class="col-lg-8">
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
                            <button type="submit">Complete Task</button>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>

    </div>
    <div class="container-fluid" style="margin-top: 30px">
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
                <input type="color" name="color" value = "#ffffff" class="form-control" id="exampleInputPassword1">
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

@endsection
