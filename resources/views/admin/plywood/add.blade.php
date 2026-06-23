                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row mb-6 gy-6">
                        <div class="col-xl">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Add Plywood</h5>
                                    <a href="{{ route('plywoods') }}" class="btn btn-secondary btn-sm">
                                        <i class="bx bx-arrow-back me-1"></i> Back
                                    </a>
                                    {{-- <small class="text-body float-end">Default label</small> --}}
                                </div>
                                <div class="card-body">
                                    <form id="add_plywood_form" method="POST" action="{{ route('plywood.store') }}">
                                        @csrf
                                        <div class="mb-6">
                                            <label class="form-label" for="name">Plywood Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="e.g. Wooden Plywood">
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




                                        <button type="submit" class="btn btn-primary">
                                            Save Menu
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
