                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row mb-6 gy-6">
                        <div class="col-xl">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Add Door</h5>
                                    <a href="{{ route('doors') }}" class="btn btn-secondary btn-sm">
                                        <i class="bx bx-arrow-back me-1"></i> Back
                                    </a>
                                    {{-- <small class="text-body float-end">Default label</small> --}}
                                </div>
                                <div class="card-body">
                                    <form id="add_door_form" method="POST" action="{{ route('door.store') }}"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-6">
                                            <label class="form-label" for="name">Door Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="e.g. Wooden Door">
                                        </div>

                                        <div class="mb-6">
                                            <label class="form-label" for="price">Price</label>
                                            <input type="number" step="0.01" class="form-control" id="price"
                                                name="price" placeholder="e.g. 250">
                                        </div>
                                        <div class="mb-6">
                                            <label class="form-label" for="price">Market Price</label>
                                            <input type="number" step="0.01" class="form-control" id="market_price"
                                                name="market_price" placeholder="e.g. 250">
                                        </div>
                                               <div class="mb-6">
                                            <label class="form-label" for="price">Unit</label>
                                            <input type="number" step="0.01" class="form-control" id="unit"
                                                name="unit" placeholder="e.g. sheet etc.">
                                        </div>
                                        <div class="mb-6">
                                            <label class="form-label" for="image"> Image</label>

                                            {{-- Preview Box --}}
                                            <div id="image_preview_wrapper" class="mb-3"
                                                style="display: none; width: 160px; height: 160px; border-radius: 10px; overflow: hidden; border: 2px solid #e0e0e0;">
                                                <img id="image_preview" src="#" alt="Image Preview"
                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>

                                            <input type="file" class="form-control" id="image" name="image"
                                                accept="image/*">

                                            <div class="form-text text-muted mt-1">
                                                Accepted formats: JPG, PNG, WEBP. Max size: 2MB.
                                            </div>
                                        </div>




                                        <button type="submit" class="btn btn-primary">
                                            Save 
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document.getElementById("image").addEventListener("change", function(e) {
                        const file = e.target.files[0];
                        const wrapper = document.getElementById("image_preview_wrapper");
                        const preview = document.getElementById("image_preview");

                        if (file && file.type.startsWith("image/")) {
                            const reader = new FileReader();
                            reader.onload = function(event) {
                                preview.src = event.target.result;
                                wrapper.style.display = "block";
                            };
                            reader.readAsDataURL(file);
                        } else {
                            preview.src = "#";
                            wrapper.style.display = "none";
                        }
                    });
                </script>
