<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mb-6 gy-6">
        <div class="col-xl">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Store Settings</h5>
                </div>

                <div class="card-body">
                    <form id="restaurant_settings_form" method="POST" action="{{ route('setting.update') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Total Table</label>
                                <input type="text" class="form-control" name="total_tables"
                                    value="{{ 11 ?? '' }}" disabled>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Restaurant Name</label>
                                <input type="text" class="form-control" name="restaurant_name"
                                    value="{{ 'sdsdsdsds' ?? '' }}" placeholder="e.g. Shree Thali House">
                            </div>

                            {{-- <div class="col-md-6 mb-4">
                                <label class="form-label">GST Percentage</label>
                                <input type="number" step="0.01" class="form-control" name="gst_percentage"
                                    value="{{ $settings->gst_percentage ?? 5 }}">
                            </div> --}}

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Parcel Charge Per Item</label>
                                <input type="number" step="0.01" class="form-control" name="parcel_charge_per_item"
                                    value="{{ 10 ?? 0 }}">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone"
                                    value="{{ 32265666 + 5 ?? '' }}" placeholder="+91 9876543210">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ 'eree@hmail.com' ?? '' }}" placeholder="restaurant@email.com">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">GST No.</label>
                                <input type="text" class="form-control" name="gst_number"
                                    value="{{ 'sdsdsdsdssd' ?? '' }}" placeholder="Gst Number">
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="address" rows="3" placeholder="Full address">{{ 'dsdsdsdsdsd' ?? '' }}</textarea>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">
                            Save Settings
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
