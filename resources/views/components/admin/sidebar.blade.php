<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ auth()->user()->role === 'super_admin' ? route('dashboard') : route('outlet_dashboard') }}"
            class="app-brand-link">
            <img src="{{ asset('admin/assets/img/logos/logo.png') }}" alt="" height="180" width="200" />
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
        </a>
    </div>

    <div class="menu-divider mt-0"></div>
    <div class="menu-inner-shadow"></div>

    @php $role = auth()->user()->role; @endphp

    <ul class="menu-inner py-1">

        {{-- DASHBOARD --}}
        <li class="menu-item {{ in_array(Request::segment(1), ['dashboard', 'outlet_dashboard']) ? 'active' : '' }}">
            <a href="{{ $role === 'super_admin' ? route('dashboard') : route('outlet_dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                <div>Dashboard</div>
            </a>
        </li>


        <li
            class="menu-item {{ in_array(Request::segment(1), ['plywoods', 'add_plywood', 'plywood_edit']) ? 'active' : '' }}">
            <a href="{{ route('plywoods') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-layer"></i>
                <div>Plywoods</div>
            </a>
        </li>

        <li class="menu-item {{ in_array(Request::segment(1), ['doors', 'add_door', 'door_edit']) ? 'active' : '' }}">
            <a href="{{ route('doors') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-door-open"></i>
                <div>Doors</div>
            </a>
        </li>

        <li
            class="menu-item {{ in_array(Request::segment(1), ['blockboards', 'add_blockboard', 'blockboard_edit']) ? 'active' : '' }}">
            <a href="{{ route('blockboards') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-grid-alt"></i>
                <div>BlockBoards</div>
            </a>
        </li>
        <li class="menu-item ">
            <a href="{{ route('enquiries') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-message-detail"></i>
                <div>Enquiries</div>
            </a>
        </li>
        <li class="menu-item {{ Request::segment(1) == 'settings' ? 'active' : '' }}">
            <a href="{{ route('setting') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div>Settings</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('logout') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-log-out"></i>
                <div>Logout</div>
            </a>
        </li>

    </ul>
</aside>
