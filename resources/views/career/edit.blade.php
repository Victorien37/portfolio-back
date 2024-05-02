@extends('components.layout')

@section('title', 'Update a career')

@section('content')

    <form action="{{ route('career.update', $experience) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">School</h5>
                    </div>
                    <div class="card-body">
                        <label for="school" class="form-label">School <span class="text-danger">*</span></label>
                        <select name="school" id="school" class="form-select">
                            <option value="" @selected($experience->school_id === null) disabled>Select a school</option>
                            @foreach ($schools as $school)
                                <option value="{{ $school->id }}" @selected($school->id === $experience->school_id)>{{ $school->name }}</option>
                            @endforeach
                        </select>

                        <label for="qualification" class="form-label">Qualification <span class="text-danger">*</span></label>
                        <input onchange="getShort('qualification')" type="text" name="qualification" id="qualification" class="form-control" value="{{ $experience->qualification }}" required />

                        <label for="qualification_short" class="form-label">Qualification short <span class="text-danger">*</span></label>
                        <input type="text" name="qualification_short" id="qualification_short" class="form-control" value="{{ $experience->qualification_short }}" required />

                        <label for="option" class="form-label">Option</label>
                        <input onchange="getShort('option')" type="text" name="option" id="option" class="form-control" value="{{ $experience->option }}" />

                        <label for="option_short" class="form-label">Option short</label>
                        <input type="text" name="option_short" id="option_short" class="form-control" value="{{ $experience->option_short }}" />
                    </div>
                    <div class="card-footer">
                        {{-- button modal to create school --}}
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#schoolModal" id="btn-modal-school">Add school</button>
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
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $experience->start_date }}" required />

                        <label for="end_date">End date <span class="text-danger">*</span></label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $experience->end_date }}" required />

                        <label for="job_title">Job title <span class="text-danger">*</span></label>
                        <input type="text" name="job_title" id="job_title" class="form-control" value="{{ $experience->job_title }}" required />

                        <label for="linked_job">Linked to my job</label>
                        <input type="checkbox" name="linked_job" id="linked_job" class="form-check-input" @checked($experience->linked_job) />

                        <br>
                        <label for="contract">Alternance</label>
                        <input onchange="alernance()" type="checkbox" name="contract" id="contract" class="form-check-input" @checked($experience->contract === 'Alternance') />

                        <label for="company"></label>
                        <select name="company" id="company" class="form-select" @disabled($experience->contract !== 'Alternance')>
                            <option value="" @selected($experience->company_id === null) disabled>Choisir une entreprise</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" @selected($experience->company_id === $company->id)>{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-footer">
                        {{-- button modal to create a company --}}
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#companyModal" id="btn-modal" @disabled($experience->contract !== 'Alternance')>Add company</button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <!-- Modal -->
    @include('components.modals.company')
    @include('components.modals.school')

@endsection
@push('footer_js')
    <script>
        const getShort = (id) => {
            const element = document.getElementById(id).value;
            const elementShort = document.getElementById(`${id}_short`);

            const elementArray = element.split(' ');

            let elementShortValue = '';
            elementArray.forEach(word => {
                const firstLetter = word[0];

                if (firstLetter === firstLetter.toUpperCase()) {
                    elementShortValue += firstLetter;
                }
            });

            elementShort.value = elementShortValue;
        }

        const alernance = () => {
            const contract  = document.getElementById('contract');
            const company   = document.getElementById('company');
            const btnModal  = document.getElementById('btn-modal');

            if (contract.checked) {
                company.disabled    = false;
                btnModal.disabled   = false;
            } else {
                company.disabled    = true;
                btnModal.disabled   = true;
            }
        }
    </script>
@endpush
