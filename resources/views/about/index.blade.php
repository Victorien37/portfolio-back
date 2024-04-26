@extends('components.layout')

@section('title', 'À propos')

@section('content')

    <h1>À propos</h1>

    <form action="{{ route('about.update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image</h5>
                    </div>
                    <div class="card-body">
                        <div id="image-selected"></div>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" name="image" id="image" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Description</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="25"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>

@endsection
