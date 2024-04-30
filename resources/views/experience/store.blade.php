@extends('components.layout')

@section('title', 'Créer une expérience')

@section('content')

    <form action="{{ route('experience.create') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Entreprise</h5>
                    </div>
                    <div class="card-body">
                        <label for="company" class="form-label"></label>
                        <select name="company" id="company" class="form-select">
                            <option value="" selected disabled>Sélectionner une entreprise</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                        <br>
                        {{-- modal button --}}
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#companyModal" id="btn-modal">Ajouter une entreprise</button>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Expérience</h5>
                    </div>
                    <div class="card-body">
                        <label for="start_date">Date de commencement <span class="text-danger">*</span></label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required />

                        <label for="end_date">Date de fin <span class="text-danger">*</span></label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required />

                        <label for="job_title">Nom du poste <span class="text-danger">*</span></label>
                        <input type="text" name="job_title" id="job_title" class="form-control" required />

                        <label for="development">Lié au développement</label>
                        <input type="checkbox" name="development" id="development" class="form-check-input" />

                        <br>
                        <label for="contract">Contrat</label>
                        <select name="contract" id="contract" class="form-select">
                            <option value="" selected disabled>Sélectionner un contrat</option>
                            @foreach ($contracts as $contract)
                                <option value="{{ $contract }}">{{ $contract }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>

    <!-- Modal -->
    @include('components.company-modal')

@endsection
