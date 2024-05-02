@extends('components.layout')

@section('title', $company->name . " projects")

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('project.store', ['companySlug' => $company->slug]) }}" class="btn btn-success">Add</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Duration</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr id="{{ $project->slug }}">
                                        <td>
                                            <img src="{{ url('storage' . $project->image->url) }}" alt="{{ $project->name }}" class="img-thumbnail" width="200" height="200" />
                                        </td>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ Carbon\Carbon::parse($project->start_date)->format('d M Y') }} - {{ Carbon\Carbon::parse($project->end_date)->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('project.edit', ['companySlug' => $company->slug, 'projectSlug' => $project->slug]) }}" class="btn btn-primary">Edit</a>
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
    <div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="deleteProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProjectModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteProject">Delete</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('footer_js')
    <script>
        const openModal = (button) => {
            const modal = new bootstrap.Modal(document.getElementById('deleteProjectModal'), {
                keyboard: false
            });
            document.getElementById('deleteProjectModalLabel').textContent = `Are you sure to delete ${button.parentElement.parentElement.children[1].textContent} ?`;
            document.getElementById('confirmDeleteProject').onclick = () => deleteProject(button);
            modal.show();
        }

        const deleteProject = (button) => {
            const projectSlug = button.parentElement.parentElement.id;
            const companySlug = @json($company->slug);

            axios.delete(`/companies/projects/${companySlug}/${projectSlug}`)
            .then(response => {
                // close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('deleteProjectModal'));
                modal.hide();
                // remove row
                document.getElementById(projectSlug).remove();

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
