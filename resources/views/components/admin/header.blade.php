 <title>{{ $title }}</title>

 <meta name="description" content="" />

 <!-- Favicon -->
 <link rel="icon" type="image/x-icon" href="{{ asset('admins/assets/img/favicon/favicon.ico') }}" />

 <!-- Fonts -->
 <link rel="preconnect" href="https://fonts.googleapis.com" />
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
 <link rel="icon" type="image/x-icon" href="{{ asset('admins/assets/img/favicon/favicon.ico') }}" />

 <link
     href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
     rel="stylesheet" />

 <link rel="stylesheet" href="{{ asset('admins/assets/vendor/fonts/iconify-icons.css') }}" />

 <!-- Core CSS -->
 <!-- build:css assets/vendor/css/theme.css  -->

 <link rel="stylesheet" href="{{ asset('admins/assets/vendor/css/core.css') }}" />
 <link rel="stylesheet" href="{{ asset('admins/assets/css/demo.css') }}" />
 <link rel="stylesheet" href="{{ asset('admins/css/new_table.css') }}" />

 <!-- Vendors CSS -->

 <link rel="stylesheet" href="{{ asset('admins/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
 <link rel="stylesheet" href="{{ asset('admins/assets/vendor/css/pages/page-auth.css') }}" />

 <!-- endbuild -->

 <link rel="stylesheet" href="{{ asset('admins/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

 <!-- Page CSS -->

 <!-- Helpers -->
 <script src="{{ asset('admins/assets/vendor/js/helpers.js') }}"></script>
 <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

 <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

 <script src="{{ asset('admins/assets/js/config.js') }}"></script>
 <link href="{{ asset('admins/assets/css/toastr.css') }}" rel="stylesheet">
 <input type="hidden" id="base_url" value="{{ url('/') }}" />
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
 <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
 <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap"
     rel="stylesheet" />
 <link
     href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
     rel="stylesheet" />
 <link
     href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
     rel="stylesheet" />
 <script id="tailwind-config">
     tailwind.config = {
         darkMode: "class",
         theme: {
             extend: {
                 colors: {
                     "primary": "#7a1f2c",
                     "background-light": "#f8f6f6",
                     "background-dark": "#1f1315",
                     "status-available": "#10b981",
                     "status-occupied": "#f59e0b",
                     "status-preparing": "#3b82f6",
                     "status-pending": "#ef4444",
                 },
                 fontFamily: {
                     "display": ["Inter", "sans-serif"]
                 },
                 borderRadius: {
                     "DEFAULT": "0.5rem",
                     "lg": "1rem",
                     "xl": "1.5rem",
                     "full": "9999px"
                 },
             },
         },
     }
 </script>
