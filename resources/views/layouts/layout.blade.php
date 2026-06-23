<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta charset="utf-8" /> --}}
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <x-admin.header title="{{ $title }}" page={{ $page }} />
    @isset($css)
        <link rel="stylesheet" href="{{ asset('assets') }}/admin/css/{{ $css }}" />
    @endisset


</head>

<body>



    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <x-admin.sidebar />
            <div class="layout-page">

                <x-admin.body_header title={{ $title }} />
                <div class="content-wrapper">

                    @include($page)
                    <div class="content-backdrop fade"></div>
                </div>
                <x-admin.body_footer />

            </div>


        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>



    {{-- <x-admin.body_footer page="{{ $page }}" /> --}}


    <x-admin.footer :js="$js ?? []" />

</body>

</html>
