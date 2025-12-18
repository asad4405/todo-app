@extends('layouts.master')
@section('content')

    <section>
        <h2 class="text-center my-3">{{ $project->name }} - Task Board</h2>
        <div class="row justify-content-center my-3">
            <div class="col-lg-5 col-12">
                <div class="mb-3">
                    <div class="progress"
                        style="height: 35px; font-size:18px; font-weight:bold; background-color: #e9ecef;">
                        <div class="progress-bar" role="progressbar" style="width: {{ $project->progress }}%;"
                            aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100"
                            id="project-progress-bar">
                            {{ $project->progress }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center pb-3">
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
                    <div class="col-12 col-md-4">
                        <div class="bg-white rounded p-3 h-100" id="todo-column">
                            <h5 class="text-center mb-3">To Do</h5>

                            @foreach ($todo_tasks as $value)
                                <div class="card mb-3 task-card" data-task="{{ $value->id }}">
                                    <div class="card-body">
                                        <h6 class="card-title mb-1">{{ $value->name }}</h6>
                                        <p class="card-text text-muted small">{{ $value->description }}</p>

                                        <select class="form-select mb-2 task-status" data-id="{{ $value->id }}">
                                            <option value="todo" {{ $value->status == 'todo' ? 'selected' : '' }}>To Do</option>
                                            <option value="inprogress" {{ $value->status == 'inprogress' ? 'selected' : '' }}>In
                                                Progress</option>
                                            <option value="done" {{ $value->status == 'done' ? 'selected' : '' }}>Done</option>
                                        </select>

                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <!-- IN PROGRESS -->
                    <div class="col-12 col-md-4">
                        <div class="bg-white rounded p-3 h-100" id="inprogress-column">
                            <h5 class="text-center">In Progress</h5>

                            @foreach ($inprogress_tasks as $value)
                                <div class="card mb-3 task-card" data-task="{{ $value->id }}">
                                    <div class="card-body">
                                        <h6 class="card-title mb-1">{{ $value->name }}</h6>
                                        <p class="card-text text-muted small">{{ $value->description }}</p>

                                        <select class="form-select mb-2 task-status" data-id="{{ $value->id }}">
                                            <option value="todo" {{ $value->status == 'todo' ? 'selected' : '' }}>To Do</option>
                                            <option value="inprogress" {{ $value->status == 'inprogress' ? 'selected' : '' }}>In
                                                Progress</option>
                                            <option value="done" {{ $value->status == 'done' ? 'selected' : '' }}>Done</option>
                                        </select>

                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- DONE -->
                    <div class="col-12 col-md-4">
                        <div class="bg-white rounded p-3 h-100" id="done-column">
                            <h5 class="text-center">Done</h5>

                            @foreach ($done_tasks as $value)
                                <div class="card mb-3 task-card" data-task="{{ $value->id }}">
                                    <div class="card-body">
                                        <h6 class="card-title mb-1">{{ $value->name }}</h6>
                                        <p class="card-text text-muted small">{{ $value->description }}</p>

                                        <select class="form-select mb-2 task-status" data-id="{{ $value->id }}">
                                            <option value="todo" {{ $value->status == 'todo' ? 'selected' : '' }}>To Do</option>
                                            <option value="inprogress" {{ $value->status == 'inprogress' ? 'selected' : '' }}>In
                                                Progress</option>
                                            <option value="done" {{ $value->status == 'done' ? 'selected' : '' }}>Done</option>
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        // CSRF setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function updateProgressBar(progress) {
            let bar = $('#project-progress-bar');
            let text = $('#project-progress-text');

            bar.css('width', progress + '%')
                .attr('aria-valuenow', progress)
                .text(progress + '%');
            text.text(progress + '%');

            bar.removeClass('bg-danger bg-warning bg-success');

            if (progress <= 33) {
                bar.addClass('bg-danger');
            } else if (progress <= 66) {
                bar.addClass('bg-warning');
            } else {
                bar.addClass('bg-success');
            }
        }

        $(document).ready(function () {
            let initialProgress = parseInt($('#project-progress-bar').attr('aria-valuenow')) || 0;
            updateProgressBar(initialProgress);
        });

        $(document).on('change', '.task-status', function () {
            let select = $(this);
            let taskId = select.data('id');
            let status = select.val();
            let card = select.closest('.task-card');

            $.ajax({
                url: `/task/${taskId}`,
                type: 'PUT',
                data: { status: status },

                success: function (res) {
                    card.hide().appendTo(`#${status}-column`).fadeIn(150);

                    if (res.project_progress !== undefined) {
                        updateProgressBar(res.project_progress);
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert('Update failed');
                }
            });
        });
    </script>





@endsection
