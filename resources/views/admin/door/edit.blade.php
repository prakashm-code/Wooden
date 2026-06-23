            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row mb-6 gy-6">
                    <div class="col-xl">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Edit Door</h5>
                                <a href="{{ route('doors') }}" class="btn btn-secondary btn-sm">
                                    <i class="bx bx-arrow-back me-1"></i> Back
                                </a>
                                {{-- <small class="text-body float-end">Default label</small> --}}
                            </div>
                            <div class="card-body">
                                <form id="edit_door_form" method="POST"
                                    action="{{ route('door.update', encrypt($data['id'])) }}">
                                    @csrf
                                    <div class="mb-6">
                                        <label class="form-label" for="name"> Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="e.g Door" value="{{ $data['name'] }}">
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label" for="price">Price </label>
                                        <input type="number" step="0.01" class="form-control" id="price"
                                            name="price" placeholder="e.g. 250" value="{{ $data['price'] }}">
                                    </div>

                                    {{-- <div class="mb-6">
                                        <label class="form-label" for="tax_percentage">Tax % (optional)</label>
                                        <input type="number" step="0.01" class="form-control " id="tax_percentage"
                                            name="tax_percentage" placeholder="e.g. 5">
                                    </div>

                                    <div class="mb-6">
                                        <label class="form-label" for="qty">Quantity</label>
                                        <input type="number" class="form-control " id="qty" name="qty"
                                            placeholder="e.g. 1">
                                    </div> --}}

                                    <button type="submit" class="btn btn-primary">
                                        Save Menu
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
