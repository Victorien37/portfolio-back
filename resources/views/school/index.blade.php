@extends('components.layout')

@section('title', "Schools")

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('school.store') }}" class="btn btn-primary">Create a new School</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schools as $school)
                                    <tr id="{{ $school->id }}">
                                        <td>
                                            <picture>
                                                <img src="{{ url('storage' . $school->image->url) }}" alt="{{ $school->name }}" class="img-thumbnail" style="width: 100px;">
                                            </picture>
                                        </td>
                                        <td>{{ $school->name }}</td>
                                        <td>{{ $school->location() }}</td>
                                        <td>
                                            <a href="{{ route('school.edit', $school) }}" class="btn btn-secondary">Edit</a>
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteSchoolModal" tabindex="-1" aria-labelledby="deleteSchoolModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSchoolModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteSchool">Delete</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('footer_js')
    <script>
        const openModal = (button) => {
            const modal = new bootstrap.Modal(document.getElementById('deleteSchoolModal'), {
                keyboard: false
            });
            document.getElementById('deleteSchoolModalLabel').textContent = `Are you sure to delete ${button.parentElement.parentElement.children[1].textContent} ?`;
            document.getElementById('confirmDeleteSchool').onclick = () => deleteSchool(button);
            modal.show();
        }

        const deleteSchool = (button) => {
            const schoolId = button.parentElement.parentElement.id;
            axios.delete(`/schools/${schoolId}`)
            .then(response => {
                // close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('deleteSchoolModal'));
                modal.hide();
                // remove row
                document.getElementById(schoolId).remove();

                console.log(response.data);

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
