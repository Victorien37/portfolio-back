@extends('components.layout')

@section('title', 'Expériences')

@section('content')

    <h1>Expériences</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="#" class="btn btn-success">Ajouter</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nom de l'entreprise</th>
                                <th>Localisation</th>
                                <th>Poste</th>
                                <th>Dates</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($experiences as $experience)
                                <tr>
                                    <td>
                                        <a href="#">{{ $experience->company->name }}</a>
                                    </td>
                                    <td>{{ $experience->company->localization() }}</td>
                                    <td>{{ $experience->position }}</td>
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
