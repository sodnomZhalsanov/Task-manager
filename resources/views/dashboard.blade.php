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
        @foreach($tasks as $task)
            <div class="alert alert-info">
                <h3>{{ $task->title }}</h3>
            </div>
        @endforeach


    </div>
    <div class="container-fluid">
        <form action="{{ route('dashboard') }}" method="post">
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

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Color</label>
                <input type="text" name="deadline" class="form-control" id="exampleInputPassword1">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Importance</label>
                <input type="number" name="importance" class="form-control" id="exampleInputPassword1">
            </div>

            <div class="mb-3">
                <input type="hidden" name="started_at" class="form-control" id="exampleInputPassword1" value="@php( date('Y-m-d') )">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
@endsection
