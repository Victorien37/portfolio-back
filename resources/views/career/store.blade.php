@extends('components.layout')

@section('title', 'Créer un parcours')

@section('content')

    <h1>Créer un parcours</h1>

    <form action="#" method="post">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Ecole</h5>
                    </div>
                    <div class="card-body">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Localisation</h5>
                            </div>
                            <div class="card-body">
                                <label for="city">Ville</label>
                                <input type="text" name="city" id="city" class="form-control" />

                                <label for="street">Rue</label>
                                <input type="text" name="street" id="street" class="form-control" />

                                <label for="zipcode">Code postal</label>
                                <input type="number" name="zipcode" id="zipcode" class="form-control" min="0" max="99999" />
                            </div>
                        </div>

                        <br>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Titre</h5>
                            </div>
                            <div class="card-body">
                                <label for="qualification">Qualification</label>
                                <input onchange="getShort('qualification')" type="text" name="qualification" id="qualification" class="form-control" />

                                <label for="qualification_short">Qualification racourcis</label>
                                <input type="text" name="qualification_short" id="qualification_short" class="form-control" />

                                <label for="option">Option</label>
                                <input onchange="getShort('option')" type="text" name="option" id="option" class="form-control" />

                                <label for="option_short">Option racourcis</label>
                                <input type="text" name="option_short" id="option_short" class="form-control" />
                            </div>
                        </div>

                        <br>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Autre</h5>
                            </div>
                            <div class="card-body">
                                <div id="image"></div>
                                <label for="image"></label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/png, image/jpeg, image/jpg" />

                                <label for="url">Url</label>
                                <input type="url" name="url" id="url" class="form-control" placeholder="https://" pattern="https://.*" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Experience</h5>
                    </div>
                    <div class="card-body">
                        <label for="start_date">Date de commencement</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" />

                        <label for="end_date">Date de fin</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" />

                        <label for="job_title">Nom du poste</label>
                        <input type="text" name="job_title" id="job_title" class="form-control" />

                        <label for="development">Lié au développement</label>
                        <input type="checkbox" name="development" id="development" class="form-check-input" />

                        <br>
                        <label for="contract">Alternance</label>
                        <input onchange="alernance()" type="checkbox" name="contract" id="contract" class="form-check-input" />

                        <label for="company"></label>
                        <select name="company" id="company" class="form-select" disabled>
                            <option value="" selected disabled>Choisir une entreprise</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
            const contract = document.getElementById('contract');
            const company = document.getElementById('company');

            if (contract.checked) {
                company.disabled = false;
            } else {
                company.disabled = true;
            }
        }
    </script>
@endpush
