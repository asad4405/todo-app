@extends('layouts.master')
@section('content')

    <section>
        <h2 class="text-center my-3">My Projects - {{ Auth::user()->email }}</h2>
        <div class="text-center my-5">
            <a href="{{ route('project.create') }}" class="bg-primary text-white p-3 rounded text-decoration-none fw-bold">+
                Create Project</a>
        </div>

        <div class="bg-light">
            <div class="container py-5">
                <h2 class="mb-4 text-center">Project List</h2>
                <div class="row g-4">
                    @foreach ($projects as $value)
                        <div class="col-12 col-md-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body d-flex flex-column">

                                    <!-- Card Header: Title + 3-dot menu -->
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0">{{ $value->name }}</h5>

                                        <!-- Dropdown 3-dot -->
                                        <div class="dropdown">
                                            <a class="text-secondary" href="#" role="button" id="dropdownMenu{{ $value->id }}"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                                </svg>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="dropdownMenu{{ $value->id }}">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('project.edit', $value->id) }}">Edit</a></li>
                                                <li>
                                                    <form action="{{ route('project.destroy', $value->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger" type="submit">Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <p class="card-text flex-grow-1">{{ $value->description }}</p>

                                    <!-- Progress Bar -->
                                    <div class="mb-3">
                                        <label class="form-label small">Progress</label>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $value->progress }}%;"
                                                aria-valuenow="{{ $value->progress }}" aria-valuemin="0" aria-valuemax="100">
                                                {{ $value->progress }}%
                                            </div>
                                        </div>
                                    </div>

                                    <!-- View Project Button -->
                                    <a href="{{ route('project.show', $value->id) }}" class="btn btn-primary mt-auto">View
                                        Project</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Project Card -->
                    {{-- <div class="col-12 col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Project A</h5>
                                <p class="card-text flex-grow-1">This is a short description of Project A.</p>

                                <!-- Progress Bar -->
                                <div class="mb-3">
                                    <label class="form-label small">Progress</label>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="70"
                                            aria-valuemin="0" aria-valuemax="100">70%</div>
                                    </div>
                                </div>

                                <!-- View Project Button -->
                                <a href="#" class="btn btn-primary mt-auto">View Project</a>
                            </div>
                        </div>
                    </div>

                    <!-- Project Card -->
                    <div class="col-12 col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Project B</h5>
                                <p class="card-text flex-grow-1">This is a short description of Project B.</p>
                                <div class="mb-3">
                                    <label class="form-label small">Progress</label>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 45%;"
                                            aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-primary mt-auto">View Project</a>
                            </div>
                        </div>
                    </div>

                    <!-- Project Card -->
                    <div class="col-12 col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Project C</h5>
                                <p class="card-text flex-grow-1">This is a short description of Project C.</p>
                                <div class="mb-3">
                                    <label class="form-label small">Progress</label>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 90%;"
                                            aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">90%</div>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-primary mt-auto">View Project</a>
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </section>


@endsection
