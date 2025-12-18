@extends('layouts.master')
@section('content')

    <section>
        <h2 class="text-center my-3">{{ $project->name }} - Task Board</h2>
        <div class="row justify-content-center my-3">
            <div class="col-lg-5 col-12">
                <div class="mb-3">
                    <label class="form-label small">Project Completion: {{ $project->progress }}%</label>
                    <div class="progress py-2">
                        <div class="progress-bar" role="progressbar" style="width: {{ $project->progress }}%;"
                            aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $project->progress }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-4 col-12">
                <div class="container">
                    <div class="card shadow-lg p-4">
                        <h3 class="card-title text-center mb-4">Add New Task</h3>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form action="{{ route('task.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <div class="mb-3">
                                <label for="taskName" class="form-label">Task Name</label>
                                <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                    placeholder="Enter task name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="taskDesc" class="form-label">Task Description</label>
                                <textarea class="form-control" name="description" rows="4"
                                    placeholder="Enter task description">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">+ Add Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="bg-light">
            <div class="container py-4">
                <div class="row g-3">

                    <!-- TO DO -->
                    <div class="col-12 col-md-4">
                        <div class="bg-white rounded p-3 h-100">
                            <h5 class="text-center mb-3">To Do</h5>

                            @foreach ($todo_tasks as $value)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title mb-1">{{ $value->name }}</h6>
                                        <p class="card-text text-muted small">{{ $value->description }}</p>

                                        <select class="form-select mb-2">
                                            <option>To Do</option>
                                            <option>In Progress</option>
                                            <option>Done</option>
                                        </select>

                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- IN PROGRESS -->
                    <div class="col-12 col-md-4">
                        <div class="bg-white rounded p-3 h-100">
                            <h5 class="text-center">In Progress</h5>

                            @foreach ($inprogress_tasks as $value)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title mb-1">{{ $value->name }}</h6>
                                        <p class="card-text text-muted small">{{ $value->description }}</p>

                                        <select class="form-select mb-2">
                                            <option>To Do</option>
                                            <option>In Progress</option>
                                            <option>Done</option>
                                        </select>

                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- DONE -->
                    <div class="col-12 col-md-4">
                        <div class="bg-white rounded p-3 h-100">
                            <h5 class="text-center">Done</h5>

                            @foreach ($done_tasks as $value)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title mb-1">{{ $value->name }}</h6>
                                        <p class="card-text text-muted small">{{ $value->description }}</p>

                                        <select class="form-select mb-2">
                                            <option>To Do</option>
                                            <option>In Progress</option>
                                            <option>Done</option>
                                        </select>

                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection
