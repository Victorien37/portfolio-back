@extends('components.layout')

@section('title', 'À propos')

@section('content')

    <form action="{{ route('about.update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image</h5>
                    </div>
                    <div class="card-body">
                        <div id="image-selected">
                            @if (auth()->user()->image)
                                <img src="{{ auth()->user()->image->url }}" alt="{{ auth()->user()->image->alt }}" />
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <input onchange="displayImage()" type="file" class="form-control" id="image" accept="image/*">
                            <input type="hidden" name="image" value="{{ auth()->user()->image_id }}" id="image_base64">
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
                            <textarea class="form-control" id="description" name="description" rows="25">{{ auth()->user()->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>

@endsection
