@extends('components.layout')

@section('title', "Update a School")

@section('content')

    <form action="{{ route('school.update', $school) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Location</h5>
                    </div>
                    <div class="card-body">
                        <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                        <input type="text" name="city" id="city" class="form-control" value="{{ $school->city }}" required />

                        <label for="street" class="form-label">Street <span class="text-danger">*</span></label>
                        <input type="text" name="street" id="street" class="form-control" value="{{ $school->street }}" required />

                        <label for="zipcode" class="form-label">Zipcode <span class="text-danger">*</span></label>
                        <input type="number" name="zipcode" id="zipcode" class="form-control" min="0" max="99999" value="{{ $school->zipcode }}" required />

                        <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                        <input type="text" name="country" id="country" class="form-control" value="{{ $school->country }}" required />
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Informations</h5>
                    </div>
                    <div class="card-body">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $school->name }}" required />

                        <label for="url">Url</label>
                        <input type="url" name="url" id="url" class="form-control" pattern="https://.*" placeholder="https://" value="{{ $school->url }}" />

                        <label for="description">Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" class="form-control" rows="3" required>{{ $school->description }}</textarea>

                        <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                        <input type="file" id="image" class="form-control" accept="image/*" onchange="displayImage()" />
                        <input type="hidden" name="image" id="image_base64" value="{{ $school->image_id }}" required />
                        <br>
                        <div id="image-selected">
                            <picture>
                                <img src="{{ url('storage' . $school->image->url) }}" alt="{{ $school->name }}" class="img-thumbnail" style="width: 100px;">
                            </picture>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection
