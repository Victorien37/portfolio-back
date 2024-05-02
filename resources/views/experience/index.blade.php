@extends('components.layout')

@section('title', 'Experiences')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('experience.store') }}" class="btn btn-success">Add</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Company name</th>
                                <th>Job</th>
                                <th>Dates</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($experiences as $experience)
                                <tr id="{{ $experience->id }}">
                                    <td>{{ $experience->company->name }}</td>
                                    <td>{{ $experience->job_title }}</td>
                                    <td>{{ $experience->getFrenchDates() }}</td>
                                    <td>
                                        <a href="{{ route('experience.edit', $experience) }}" class="btn btn-primary">Edit</a>
                                        <button type="button" class="btn btn-danger" onclick="openModal(this)">Delete</button>
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
    <div class="modal fade" id="deleteExperienceModal" tabindex="-1" aria-labelledby="deleteExperienceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteExperienceModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteExperience">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer_js')
    <script>
        const openModal = (button) =>  {
            const modal = new bootstrap.Modal(document.getElementById('deleteExperienceModal'), {
                keyboard: false
            });
            document.getElementById('deleteExperienceModalLabel').textContent = `Are you sure to delete ${button.parentElement.parentElement.children[1].textContent} ?`;
            document.getElementById('confirmDeleteExperience').onclick = () => deleteSchool(button);
            modal.show();
        }

        const deleteSchool = (button) => {
            const id = button.parentElement.parentElement.id;
            axios.delete(`/experiences/${id}`)
            .then(response => {
                // close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('deleteExperienceModal'));
                modal.hide();
                // remove row
                document.getElementById(id).remove();

                let html = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>${response.data}</strong>
                    </div>
                `;
                document.getElementById('message').innerHTML = html;

                setTimeout(() => {
                    document.getElementById('message').innerHTML = '';
                }, 10000);
            });
        }
    </script>
@endpush
