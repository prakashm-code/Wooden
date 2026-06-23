@php
    $user = Auth::user();
@endphp

<div class="container-xxl flex-grow-1 container-p-y">

    {{-- ALERTS --}}
    {{-- @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class='bx bx-check-circle me-2'></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('success_password'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class='bx bx-lock me-2'></i> {{ session('success_password') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif --}}

    <div class="row mb-6 gy-6">

        {{-- ── PROFILE INFO + PHOTO ── --}}
        <div class="col-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Profile Settings</h5>
                </div>
                <div class="card-body">
                    <form id="profile_update_form"
                          method="POST"
                          action="{{ route('setting.profile_update') }}"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            {{-- Photo --}}
                            <div class="col-md-12 mb-4">
                                <label class="form-label">Profile Photo</label>
                                <div class="d-flex align-items-center gap-4">

                                    {{-- Preview --}}
                                    <div style="position:relative;display:inline-block;flex-shrink:0;">
                                        @if($user->profile_photo)
                                            <img id="photo-preview"
                                                 src="{{ asset('uploads/profiles/' . $user->profile_photo) }}"
                                                 class="rounded-circle"
                                                 style="width:80px;height:80px;object-fit:cover;
                                                        border:3px solid #6c63ff;">
                                        @else
                                            <div id="photo-initials"
                                                 style="width:80px;height:80px;border-radius:50%;
                                                        background:linear-gradient(135deg,#6c63ff,#9c8fff);
                                                        display:flex;align-items:center;justify-content:center;
                                                        font-size:30px;color:#fff;font-weight:800;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <img id="photo-preview"
                                                 src=""
                                                 class="rounded-circle d-none"
                                                 style="width:80px;height:80px;object-fit:cover;
                                                        border:3px solid #6c63ff;">
                                        @endif

                                        {{-- Camera icon --}}
                                        <label for="profile_photo"
                                               style="position:absolute;bottom:2px;right:2px;
                                                      width:24px;height:24px;border-radius:50%;
                                                      background:#6c63ff;color:#fff;cursor:pointer;
                                                      display:flex;align-items:center;justify-content:center;
                                                      box-shadow:0 2px 6px rgba(0,0,0,0.2);">
                                            <i class='bx bx-camera' style="font-size:12px;"></i>
                                        </label>
                                    </div>

                                    {{-- Upload info --}}
                                    <div>
                                        <div class="fw-semibold mb-1" style="font-size:14px;">
                                            {{ $user->name }}
                                        </div>
                                        <div class="text-muted mb-2" style="font-size:12px;">
                                            {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                        </div>
                                        <div class="text-muted" style="font-size:11px;">
                                            Click camera icon to change · JPG, PNG, WEBP · Max 2MB
                                        </div>
                                        @error('profile_photo')
                                            <div class="text-danger mt-1" style="font-size:12px;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>

                                {{-- Hidden file input --}}
                                <input type="file"
                                       name="profile_photo"
                                       id="profile_photo"
                                       class="d-none"
                                       accept="image/jpg,image/jpeg,image/png,image/webp">
                            </div>

                            {{-- Name --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Full Name</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       value="{{ old('name', $user->name) }}"
                                       placeholder="e.g. John Doe">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Email</label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email"
                                       value="{{ old('email', $user->email) }}"
                                       placeholder="e.g. john@email.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Phone --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Phone</label>
                                <input type="text"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       name="phone"
                                       value="{{ old('phone', $user->phone) }}"
                                       placeholder="e.g. 9876543210">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Role (disabled) --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Role</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ ucfirst(str_replace('_', ' ', $user->role)) }}"
                                       disabled>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class='bx bx-save me-1'></i> Save Profile
                        </button>

                    </form>
                </div>
            </div>
        </div>

    </div>

    {{-- ── CHANGE PASSWORD ── --}}


</div>

<script>
    // Image preview on file select
    document.getElementById('profile_photo').addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        const reader  = new FileReader();
        reader.onload = function (e) {
            const preview  = document.getElementById('photo-preview');
            const initials = document.getElementById('photo-initials');

            preview.src = e.target.result;
            preview.classList.remove('d-none');

            if (initials) initials.style.display = 'none';
        };
        reader.readAsDataURL(file);
    });
</script>
