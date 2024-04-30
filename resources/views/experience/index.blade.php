@extends('components.layout')

@section('title', 'Expériences')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('experience.store') }}" class="btn btn-success">Ajouter</a>
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
                                <tr id="{{ $experience->id }}">
                                    <td>
                                        <a href="{{ route('company.edit') }}">{{ $experience->company->name }}</a>
                                    </td>
                                    <td>{{ $experience->company->localization() }}</td>
                                    <td>{{ $experience->position }}</td>
                                    <td>{{ $experience->start_date }} - {{ $experience->end_date }}</td>
                                    <td>
                                        <a href="{{ route('experience.edit') }}" class="btn btn-primary">Modifier</a>

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
