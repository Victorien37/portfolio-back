@extends('components.layout')

@section('title', 'Parcours')

@section('content')

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
                                <tr id="{{ $experience->id }}">
                                    <td>{{ $experience->school->name }}</td>
                                    <td>{{ $experience->school->localization() }}</td>
                                    <td>{{ $experience->school->qualification }}</td>
                                    <td>{{ $experience->school?->option }}</td>
                                    <td>{{ $experience->getFrenchDates() }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary">Modifier</a>
                                        <button type="button" class="btn btn-danger" onclick="openModal(this)">Supprimer</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteCareer">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('footer_js')
    <script>
        const openModal = (button) => {
            const modal = new bootstrap.Modal(document.getElementById('exampleModal'), {
                keyboard: false
            });
            document.getElementById('exampleModalLabel').textContent = `Supprimer l'expérience de ${button.parentElement.parentElement.children[0].textContent} ?`;
            document.getElementById('confirmDeleteCareer').onclick = () => deleteCareer(button);
            modal.show();
        }

        const deleteCareer = (button) => {
            const id = button.parentElement.parentElement.id;
            console.log(id);
            axios.delete(`/career/${id}`)
            .then(response => {
                // close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
                modal.hide();
                document.getElementById(id).remove();
            });
        }
    </script>
@endpush
