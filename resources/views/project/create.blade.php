@extends('layouts.master')
@section('content')

    <section>
        <div class="bg-light">
            <div class="container d-flex justify-content-center align-items-center min-vh-100">
                <div class="card shadow-sm p-4" style="max-width: 500px; width: 100%;">
                    <h3 class="card-title text-center mb-4">Create New Project</h3>
                    <form action="{{ route('project.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Project Name</label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Enter project name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="projectDesc" class="form-label">Project Description</label>
                            <textarea class="form-control" name="description" rows="4"
                                placeholder="Enter project description">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Create Project</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection
