@extends('components.layout')

@section('title', 'Create an experience')

@section('content')

    <form action="{{ route('experience.create') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Company</h5>
                    </div>
                    <div class="card-body">
                        <label for="company" class="form-label">Company <span class="text-danger">*</span></label>
                        <select name="company" id="company" class="form-select">
                            <option value="" selected disabled>Select a company</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-footer">
                        {{-- button modal to create company --}}
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#companyModal" id="btn-modal">Add a company</button>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Experience</h5>
                    </div>
                    <div class="card-body">
                        <label for="start_date">Start date <span class="text-danger">*</span></label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required />

                        <label for="end_date">End date <span class="text-danger">*</span></label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required />

                        <label for="job_title">Job title <span class="text-danger">*</span></label>
                        <input type="text" name="job_title" id="job_title" class="form-control" required />

                        <label for="linked_job">Linked to my job</label>
                        <input type="checkbox" name="linked_job" id="linked_job" class="form-check-input" />

                        <br>
                        <label for="contract">Contract</label>
                        <select name="contract" id="contract" class="form-select">
                            <option value="" selected disabled>Select a contract</option>
                            @foreach ($contracts as $contract)
                                <option value="{{ $contract }}">{{ $contract }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>

    <!-- Modal -->
    @include('components.modals.company')

@endsection
