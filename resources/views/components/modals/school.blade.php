<div class="modal fade" id="schoolModal" tabindex="-1" aria-labelledby="schoolModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="schoolModalLabel">Add a school</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="school-name" class="form-label">Name</label>
                <input type="text" id="school-name" class="form-control" />

                <label for="school-description" class="form-label">Description</label>
                <textarea id="school-description" cols="15" rows="5" class="form-control"></textarea>

                <label for="school-city" class="form-label">City</label>
                <input type="text" id="school-city" class="form-control" />

                <label for="school-street" class="form-label">Street</label>
                <input type="text" id="school-street" class="form-control" />

                <label for="school-zipcode" class="form-label">Zipcode</label>
                <input type="number" id="school-zipcode" min="0" max="99999" class="form-control" />

                <label for="school-country" class="form-label">Country</label>
                <input type="text" id="school-country" class="form-control" />

                <label for="school-url" class="form-label">Url</label>
                <input type="url" id="school-url" pattern="https://" placeholder="https://" class="form-control" />

                <label for="school-image-chose" class="form-label">Image</label>
                <div id="school-image-select"></div>
                <input onchange="displaySchoolImage()" class="form-control" type="file" id="school-image-chose" accept="image/png, image/jpeg, image/jpg" />
                <input type="hidden" id="school-image" value="" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addSchool()">Add</button>
            </div>
        </div>
    </div>
</div>

@push('footer_js')
    <script>
        const displaySchoolImage = () => {
            const image         = document.getElementById('school-image-chose');
            const imageSelected = document.getElementById('school-image-select');
            const imageBase64   = document.getElementById('school-image');

            imageSelected.innerHTML = '';

            if (image.files.length > 0) {
                const reader = new FileReader();
                reader.onloadend = (e) => {
                    const img           = document.createElement('img');
                    img.src             = e.target.result;
                    img.classList.add('img-fluid');
                    imageBase64.value   = e.target.result.split(',')[1];
                    imageSelected.appendChild(img);
                };
                reader.readAsDataURL(image.files[0]);
            }
        }

        const addSchool = () => {
            const name        = document.getElementById('school-name').value;
            const description = document.getElementById('school-description').value;
            const city        = document.getElementById('school-city').value;
            const street      = document.getElementById('school-street').value;
            const zipcode     = document.getElementById('school-zipcode').value;
            const country     = document.getElementById('school-country').value;
            const url         = document.getElementById('school-url').value;
            const image       = document.getElementById('school-image').value;

            axios.post("{{ route('school.axios.create') }}", {
                name:           name,
                description:    description,
                city:           city,
                street:         street,
                zipcode:        zipcode,
                country:        country,
                url:            url,
                image:          image
            }).then(response => {
                const school = response.data.data;

                [name, description, city, street, zipcode, country, url, image].forEach(element => {
                    element.value = '';
                });

                // Add school to select
                const schoolSelect = document.getElementById('school');
                const option       = document.createElement('option');
                option.value       = school.id;
                option.text        = school.name;
                schoolSelect.appendChild(option);

                // Display message
                let message = `
                    <div class="alert alert-success alert-block">
                        <strong>${response.data.message}</strong>
                    </div>
                `;
                document.getElementById('message').innerHTML = message;

                // Close modal
                let myModal = bootstrap.Modal.getInstance(document.getElementById('schoolModal'));
                myModal.hide();
            }).catch(error => {
                let message = `
                    <div class="alert alert-danger alert-block">
                        <strong>An error has occured</strong>
                    </div>
                `;
                document.getElementById('message').innerHTML = message;

                let myModal = bootstrap.Modal.getInstance(document.getElementById('schoolModal'));
                myModal.hide();
            });
        }
    </script>
@endpush
