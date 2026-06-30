 {{-- <script src="{{ asset('admins/assets/vendor/libs/jquery/jquery.js') }}"></script> --}}
 {{-- <script src="{{ asset('admins/assets/js/jquery.min.js') }}"></script>
 <script src="{{ asset('admins/assets/js/jquery.validate.min.js') }}"></script>
 <script src="{{ asset('admins/assets/js/additional-methods.min.js') }}"></script> --}}

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/additional-methods.min.js"></script>
 <script src="{{ asset('admins/assets/js/toastr.min.js') }}"></script>
 <script src="{{ asset('admins/assets/js/jquery.dataTables.min.js') }}"></script>

 <script src="{{ asset('admins/assets/vendor/libs/popper/popper.js') }}"></script>
 <script src="{{ asset('admins/assets/vendor/js/bootstrap.js') }}"></script>

 <script src="{{ asset('admins/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

 <script src="{{ asset('admins/assets/vendor/js/menu.js') }}"></script>

 <!-- endbuild -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <!-- Vendors JS -->
 {{-- <script src="{{ asset('admins/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script> --}}

 <!-- Main JS -->

 <script src="{{ asset('admins/assets/js/main.js?v=78') }}"></script>
 <script src="{{ asset('admins/css/order.css') }}"></script>
 <script src="{{ asset('admins/css/table.css') }}"></script>

 <!-- Page JS -->
 <script src="{{ asset('admins/assets/js/dashboards-analytics.js') }}"></script>
 <script src="{{ asset('admins/js/table.js') }}"></script>

 <!-- Place this tag before closing body tag for github widget button. -->
 <script async defer src="https://buttons.github.io/buttons.js"></script>

 {{-- {{ dd(session('msg_error')) }} --}}
 <script>
     var base_url = $("#base_url").val();

     @if (session('msg_error'))
         toastr.error("{{ session('msg_error') }}");
     @endif

     @if (session('msg_success'))
         toastr.success("{{ session('msg_success') }}");
     @endif

     @if (isset($errors) && $errors->any())
         @foreach ($errors->all() as $error)
             toastr.error("{{ $error }}");
         @endforeach
     @endif
 </script>
 @if (isset($js))
     {{-- {{ dd($js) }} --}}
     @foreach ($js as $value)
         <script src="{{ asset('admins') }}/js/{{ $value }}.js?v=9.1"></script>
     @endforeach
 @endif


 <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>

 <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

 <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
