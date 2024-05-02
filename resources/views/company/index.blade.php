@extends('components.layout')

@section('title', "Companies")

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('company.store') }}" class="btn btn-success">Add</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr id="{{ $company->slug }}">
                                        <td>
                                            <img src="{{ url('storage' . $company->image->url) }}" alt="{{ $company->name }}" class="img-thumbnail" width="200" height="200" />
                                        </td>
                                        <td>{{ $company->name }}</td>
                                        <td>
                                            <a href="{{ route('company.edit', $company->slug) }}" class="btn btn-primary">Edit</a>
                                            <button type="button" class="btn btn-danger" onclick="openModal(this)">Delete</button>
                                            <a href="{{ route('project.index', $company->slug) }}" class="btn btn-info">Projects</button>
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
    <div class="modal fade" id="deleteCompanyModal" tabindex="-1" aria-labelledby="deleteCompanyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCompanyModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteCompany">Delete</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('footer_js')
    <script>
        const openModal = (button) => {
            const modal = new bootstrap.Modal(document.getElementById('deleteCompanyModal'), {
                keyboard: false
            });
            document.getElementById('deleteCompanyModalLabel').textContent = `Are you sure to delete ${button.parentElement.parentElement.children[1].textContent} ?`;
            document.getElementById('confirmDeleteCompany').onclick = () => deleteCompany(button);
            modal.show();
        }

        const deleteCompany = (button) => {
            const slug = button.parentElement.parentElement.id;
            axios.delete(`/companies/${slug}`)
            .then(response => {
                // close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('deleteCompanyModal'));
                modal.hide();
                // remove row
                document.getElementById(slug).remove();

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
