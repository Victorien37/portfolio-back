@extends('components.layout')

@section('title', 'Parcours')

@section('content')

    <h1>Parcours</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('career.store') }}" class="btn btn-success">Ajouter</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nom de l'école</th>
                                <th>Localisation</th>
                                <th>Qualification</th>
                                <th>Option</th>
                                <th>Dates</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($experiences as $experience)
                                <tr>
                                    <td>{{ $experience->school->name }}</td>
                                    <td>{{ $experience->school->localization() }}</td>
                                    <td>{{ $experience->school->qualification }}</td>
                                    <td>{{ $experience->school?->option }}</td>
                                    <td>{{ $experience->start_date }} - {{ $experience->end_date }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary">Modifier</a>
                                        <a href="#" class="btn btn-danger">Supprimer</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
