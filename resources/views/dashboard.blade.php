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
        @foreach($taskUsers as $el)

            <div class="alert alert-info">
                <h2>{{ ($el[0]->getTaskById($el[0]->task_id))->title }}</h2>
                @foreach($el as $user_mail)
                    <h1>{{ $user_mail->getEmailById($user_mail->user_id) }}</h1>
                @endforeach
            </div>

            <form action="{{ route('addCoworker') }}" method="post"
                  id="addto{{($el[0]->getTaskById($el[0]->task_id))->id}}">
                @csrf
                <div class="mb-3">
                    <input type="hidden" name="task_id" class="form-control" id="exampleInputPassword1"
                           value="{{($el[0]->getTaskById($el[0]->task_id))->id}}">
                </div>
                @error('task_id')
                <span class='label-text'>{{ $message }}</span>
                @enderror
                <div class="mb-3">
                    <input type="text" name="executor_mail"
                           list="executors_{{($el[0]->getTaskById($el[0]->task_id))->id}}" class="form-control"
                           id="exampleInputPassword1">
                </div>
                <datalist id="executors_{{($el[0]->getTaskById($el[0]->task_id))->id}}">
                    @foreach($users as $user)
                        <option value="{{$user->email}}">
                    @endforeach
                </datalist>
                @error('executor_mail')
                <span class='label-text'>{{ $message }}</span>
                @enderror
                <button type="submit" form="addto{{($el[0]->getTaskById($el[0]->task_id))->id}}"
                        class="btn btn-primary">Add executor
                </button>

            </form>

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
