@extends('components.layout')

@section('title', 'Modifier une expérience')

@section('content')

    <form action="{{ route('experience.update') }}" method="POST">
        @method('PUT')
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
                            <option value="" @selected($experience->company_id === null) disabled>Sélectionner une entreprise</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" @selected($company->id === $experience->company_id)>{{ $company->name }}</option>
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
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $experience->start_date }}" required />

                        <label for="end_date">Date de fin <span class="text-danger">*</span></label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $experience->end_date }}" required />

                        <label for="job_title">Nom du poste <span class="text-danger">*</span></label>
                        <input type="text" name="job_title" id="job_title" class="form-control" value="{{ $experience->job_title }}" required />

                        <label for="development">Lié au développement</label>
                        <input type="checkbox" name="development" id="development" class="form-check-input" @checked($experience->development) />

                        <br>
                        <label for="contract">Contrat</label>
                        <select name="contract" id="contract">
                            @foreach ($contracts as $contract)
                                <option value="{{ $contract }}" @selected($experience->contract === $contract)>{{ $contract }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal -->
    @include('components.company-modal')

@endsection
