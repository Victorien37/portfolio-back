@extends('components.layout')

@section('title', "Create a Company")

@section('content')

    <form action="{{ route('company.create') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image <span class="text-danger">*</span></h5>
                    </div>
                    <div class="card-body">
                        <label for="image" class="form-label"></label>
                        <input onchange="displayImage()" type="file" id="image" accept="image/*" class="form-control" />
                        <input type="hidden" name="image" id="image_base64" required />
                        <div id="image-selected"></div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Informations <span class="text-danger">*</span></h5>
                    </div>
                    <div class="card-body">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" required />

                        <label for="url" class="form-label">Url</label>
                        <input type="url" id="url" name="url" class="form-control" pattern="https://.*" placeholder="https://" required />

                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-control" required></textarea>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Location <span class="text-danger">*</span></h5>
                    </div>
                    <div class="card-body">
                        <label for="city" class="form-label">City</label>
                        <input type="text" id="city" name="city" class="form-control" required />

                        <label for="street" class="form-label">Street</label>
                        <input type="text" id="street" name="street" class="form-control" required />

                        <label for="zipcode" class="form-label">Zipcode</label>
                        <input type="number" id="zipcode" name="zipcode" class="form-control" min="0" max="99999" required />

                        <label for="country" class="form-label">Country</label>
                        <input type="text" id="country" name="country" class="form-control" required />
                    </div>
                </div>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>

@endsection
