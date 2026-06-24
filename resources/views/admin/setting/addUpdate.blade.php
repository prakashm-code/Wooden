<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mb-6 gy-6">
        <div class="col-xl">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Store Settings</h5>
                </div>

                <div class="card-body">
                    <form id="settings_form" method="POST" action="{{ route('setting.update') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-4">
                                <label class="form-label"> Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ $settings->name ?? '' }}" placeholder="e.g. name">
                            </div>


                            <div class="col-md-6 mb-4">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone"
                                    value="{{ $settings->phone ?? '' }}" placeholder="+91 9876543210">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ $settings->email ?? '' }}" placeholder="sasa@email.com">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">GST No.</label>
                                <input type="text" class="form-control" name="gst_number"
                                    value="{{ $settings->gst_number ?? '' }}" placeholder="Gst Number">
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="address" rows="3" placeholder="Full address">{{ $settings->address ?? '' }}</textarea>
                            </div>


                            <div class="col-md-6 mb-4">
                                <label class="form-label">Logo</label>
                                <input type="file" class="form-control" name="logo" accept="image/*"
                                    onchange="previewImage(event, 'logo_preview')">
                                <div class="mt-2">
                                    <img id="logo_preview"
                                        src="{{ $settings->logo ? asset('admin/uploads/settings/' . $settings->logo) : '' }}"
                                        alt="Logo Preview"
                                        style="{{ $settings->logo ? '' : 'display:none;' }} width:150px; height:150px; object-fit:contain; border:1px solid #ddd; border-radius:8px; padding:6px;">
                                </div>
                            </div>

                            {{-- Favicon Upload --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Favicon</label>
                                <input type="file" class="form-control" name="favicon" accept="image/*"
                                    onchange="previewImage(event, 'favicon_preview')">
                                <div class="mt-2">
                                    <img id="favicon_preview"
                                        src="{{ $settings->favicon ? asset('admin/uploads/settings/' . $settings->favicon) : '' }}"
                                        alt="Favicon Preview"
                                        style="{{ $settings->favicon ? '' : 'display:none;' }} width:64px; height:64px; object-fit:contain; border:1px solid #ddd; border-radius:8px; padding:4px;">
                                </div>
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


<script>
    function previewImage(event, previewId) {
        const preview = document.getElementById(previewId);
        const file = event.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    }
</script>
