@extends('layouts.master')
@section('content')

    <section>
        <h2 class="text-center my-3">{{ $project->name }} - Task Board</h2>
        <div class="row justify-content-center my-3">
            <div class="col-lg-5 col-12">
                <div class="mb-3">
                    <label class="form-label small">Project Completion: {{ $project->progress }}%</label>
                    <div class="progress">
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
                        <form action="" method="POST">
                            @csrf
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
                            <button type="submit" class="btn btn-primary w-100">Add Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
