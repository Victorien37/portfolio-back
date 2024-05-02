@extends('components.layout')

@section('title', "Update " . $project->name . " project for " . $company->name)

@section('content')

    <form action="{{ route('project.update', ['companySlug' => $company->slug, 'projectSlug' => $project->slug]) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Project</h5>
                    </div>
                    <div class="card-body">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $project->name }}" required />

                        <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $project->start_date }}" required />

                        <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $project->end_date }}" required />

                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" class="form-control" required >{{ $project->description }}</textarea>

                        <label for="url" class="form-label">Url <span class="text-danger">*</span></label>
                        <input type="url" name="url" id="url" class="form-control" pattern="https://.*" placeholder="https://" value="{{ $project->url }}" required />

                        <label for="url2" class="form-label">Second url</label>
                        <input type="url" name="url2" id="url2" class="form-control" pattern="https://.*" placeholder="https://" value="{{ $project->url2 }}" />

                        <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                        <input onchange="displayImage()" type="file" id="image" class="form-control" />
                        <input type="hidden" name="image" id="image_base64" value="{{ $project->image_id }}" required />
                        <br>
                        <div id="image-selected">
                            <img src="{{ url('storage' . $project->image->url) }}" alt="{{ $project->name }}" class="img-thumbnail" width="200" height="200" />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection
