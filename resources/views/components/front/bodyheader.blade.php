<!-- ========== NAVBAR ========== -->
<nav class="navbar" id="navbar">
    <div class="nav-container">
        <div class="logo">
            {{-- <span class="logo-icon">🪵</span>
            <div>
                <span class="logo-main">WoodCraft</span>
                <span class="logo-sub">Premium</span>
            </div> --}}

            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/logos/logo.png') }}" height="120" width="160" class="logo-icon"
                    alt="WoodCraft Premium">
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('listing', ['cat' => 'plywoods']) }}">Plywoods</a></li>
            <li><a href="{{ route('listing', ['cat' => 'blockboards']) }}">Blockboard</a></li>
            <li><a href="{{ route('listing', ['cat' => 'doors']) }}">Doors</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact" class="nav-cta">Contact Us</a></li>
        </ul>
        @if (!empty($settings->phone))
            <div class="nav-phone">📞 {{ $settings->phone }}</div>
        @endif
        <button class="hamburger" id="hamburger">☰</button>
    </div>
</nav>
