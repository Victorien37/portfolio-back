<div class="modal fade" id="companyModal" tabindex="-1" aria-labelledby="companyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="companyModalLabel">Add a company</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="company-name" class="form-label">Name</label>
                <input type="text" id="company-name" class="form-control" />

                <label for="company-description" class="form-label">Description</label>
                <textarea id="company-description" cols="15" rows="5" class="form-control"></textarea>

                <label for="company-city" class="form-label">City</label>
                <input type="text" id="company-city" class="form-control" />

                <label for="company-street" class="form-label">Street</label>
                <input type="text" id="company-street" class="form-control" />

                <label for="company-zipcode" class="form-label">Zipcode</label>
                <input type="number" id="company-zipcode" min="0" max="99999" class="form-control" />

                <label for="company-country" class="form-label">Country</label>
                <input type="text" name="company-country" id="company-country" class="form-control" />

                <label for="company-url" class="form-label">Url</label>
                <input type="url" id="company-url" pattern="https://" placeholder="https://" class="form-control" />

                <label for="company-image-chose" class="form-label">Image</label>
                <div id="company-image-select"></div>
                <input onchange="displayCompanyImage()" class="form-control" type="file" id="company-image-chose" accept="image/png, image/jpeg, image/jpg" />
                <input type="hidden" id="company-image" value="" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addCompany()">Add</button>
            </div>
        </div>
    </div>
</div>

@push('footer_js')
    <script>
        const displayCompanyImage = () => {
            const image         = document.getElementById('company-image-chose');
            const imageSelected = document.getElementById('company-image-select');
            const imageBase64   = document.getElementById('company-image');

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

        const addCompany = () => {
            const name        = document.getElementById('company-name').value;
            const description = document.getElementById('company-description').value;
            const city        = document.getElementById('company-city').value;
            const street      = document.getElementById('company-street').value;
            const zipcode     = document.getElementById('company-zipcode').value;
            const country     = document.getElementById('company-country').value;
            const url         = document.getElementById('company-url').value;
            const image       = document.getElementById('company-image').value;

            axios.post("{{ route('company.create') }}", {
                name:           name,
                description:    description,
                city:           city,
                street:         street,
                zipcode:        zipcode,
                country:        country,
                url:            url,
                image:          image
            }).then(response => {
                const company = response.data.data;

                [name, description, city, street, zipcode, country, url, image].forEach(element => {
                    element.value = '';
                });

                // Add company to select
                const companySelect = document.getElementById('company');
                const option        = document.createElement('option');
                option.value        = company.id;
                option.text         = company.name;
                companySelect.appendChild(option);


                // Display message
                let message = `
                <div class="alert alert-success alert-block">
                    <strong>${response.data.message}</strong>
                </div>
                `;
                document.getElementById('message').innerHTML = message;

                // Close modal
                let myModal = bootstrap.Modal.getInstance(document.getElementById('companyModal'));
                myModal.hide();
            }).catch(error => {
                let message = `
                    <div class="alert alert-danger alert-block">
                        <strong>An error has occured while creating company</strong>
                    </div>
                `;
                document.getElementById('message').innerHTML = message;

                // Close modal
                let myModal = bootstrap.Modal.getInstance(document.getElementById('companyModal'));
                myModal.hide();
            });
        }
    </script>
@endpush
