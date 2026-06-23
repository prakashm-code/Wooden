


                 <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row mb-6 gy-6">
                        <div class="col-xl">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Update Password</h5>
                                    {{-- <small class="text-body float-end">Default label</small> --}}
                                </div>
                                <div class="card-body">
                     <form id="change_pwd_form"class="mb-6" method="POST" action="{{ route('change_pwd_store') }}">
                                        @csrf
                                        <div class="mb-6">
                                              <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Please enter password">
                                        </div>
                                         <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                        <div class="mb-6">
                                            <label for="c_password" class="form-label">Confirm Password </label>
                         <input  type="password" class="form-control" id="c_password" name="c_password"
                             placeholder="Confirm your password" autofocus />
                                        </div>



                                        <button type="submit" class="btn btn-primary">
                                           Update Password
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
