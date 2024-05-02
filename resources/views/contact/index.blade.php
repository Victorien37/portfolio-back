@extends('components.layout')

@section('title', 'Contacts')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (count($contacts) === 0)
                        <h5 class="card-title">No contact at the moment</h5>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Message</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $contact)
                                        <tr id="{{ $contact->id }}">
                                            <td>{{ $contact->firstname }} {{ $contact->lastname }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->phone ? $contact->phone : "NaN" }}</td>
                                            <td>{{ $contact->message }}</td>
                                            <td>{{ $contact->created_at->format('d M Y H:i:s') }}</td>
                                            <td>
                                                <a href="mailto:{{ $contact->email }}" class="link_primary">Send email</a>
                                                <button type="button" class="btn btn-danger" onclick="openModal(this)">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteContactModal" tabindex="-1" aria-labelledby="deleteContactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteContactModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteContact">Delete</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('footer_js')
    <script>
        const openModal = (button) => {
            const modal = new bootstrap.Modal(document.getElementById('deleteContactModal'), {
                keyboard: false
            });
            document.getElementById('deleteContactModalLabel').textContent = `Are you sure to delete ${button.parentElement.parentElement.children[1].textContent} ?`;
            document.getElementById('confirmDeleteContact').onclick = () => deleteContact(button);
            modal.show();
        }

        const deleteContact = (button) => {
            const id = button.parentElement.parentElement.id;
            axios.delete(`/contacts/${id}`)
            .then(response => {
                // close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('deleteContactModal'));
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
