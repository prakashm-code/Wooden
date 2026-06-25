<!-- LISTING HERO -->
<div class="listing-hero">
    <div class="listing-hero-inner">
        <div class="listing-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="sep">›</span>
            <span class="current">
                @if ($category === 'plywoods')
                    Plywoods
                @elseif($category === 'doors')
                    Doors
                @else
                    Blockboard
                @endif
            </span>
        </div>
        <h1>Our <span>
                @if ($category === 'plywoods')
                    Plywoods
                @elseif($category === 'doors')
                    Doors
                @else
                    Blockboard
                @endif
            </span></h1>
        <p>
            @if ($category === 'plywoods')
                Engineered for strength, finished for beauty
            @elseif($category === 'doors')
                Where first impressions are crafted in wood
            @else
                The backbone of every great furniture piece
            @endif
        </p>
        <span class="listing-count" id="productCount">
            @if ($category === 'plywoods')
                {{ count($plywoods) }} Products
            @elseif($category === 'doors')
                {{ count($doors) }} Products
            @else
                {{ count($blockboards) }} Products
            @endif
        </span>
    </div>
</div>

<!-- FILTER BAR -->
<div class="filter-bar">
    <div class="filter-inner">
        <span class="filter-label">Filter:</span>
        <div class="filter-pills">
            <button class="filter-pill active" onclick="filterProducts('All', this)">All</button>
            {{-- @if ($category === 'plywoods')
                    @foreach (['BWP 710', 'MR Grade', 'Fire Retardant', 'Calibrated', 'Premium'] as $tag)
                        <button class="filter-pill"
                            onclick="filterProducts('{{ $tag }}', this)">{{ $tag }}</button>
                    @endforeach
                @elseif($category === 'doors')
                    @foreach (['Flush Door', 'Panel Door', 'WPC', 'Membrane', 'Designer'] as $tag)
                        <button class="filter-pill"
                            onclick="filterProducts('{{ $tag }}', this)">{{ $tag }}</button>
                    @endforeach
                @else
                    @foreach (['Teak', 'Pine Core', 'MDF Core', 'BWR', 'Premium'] as $tag)
                        <button class="filter-pill"
                            onclick="filterProducts('{{ $tag }}', this)">{{ $tag }}</button>
                    @endforeach
                @endif --}}
        </div>
        <select class="filter-sort" id="sortSelect" onchange="sortProducts(this.value)">
            <option value="default">Sort: Default</option>
            <option value="price-low">Price: Low to High</option>
            <option value="price-high">Price: High to Low</option>
            <option value="name">Name: A to Z</option>
        </select>
    </div>
</div>

<!-- LISTING GRID -->
<div class="listing-body">
    <div class="listing-grid" id="listingGrid">

        @php
            $products = $category === 'plywoods' ? $plywoods : ($category === 'doors' ? $doors : $blockboards);
        @endphp

        @forelse($products as $i => $p)
            {{-- @php
                    $badgeColor = match ($p['badge'] ?? '') {
                        'Best Seller', 'Top Pick' => 'var(--red)',
                        'New', 'Trending' => '#16a34a',
                        'Hot Deal', 'Best Value' => 'var(--orange)',
                        default => 'var(--red)',
                    };
                @endphp --}}

            <div class="product-card reveal visible" data-tag="{{ $p['tag'] ?? '' }}"
                data-price="{{ $p['price'] ?? 0 }}" data-name="{{ $p['name'] ?? '' }}"
                style="animation-delay: {{ $i * 60 }}ms">
                {{-- @if (!empty($p['badge']))
                        <div class="card-badge" style="background: {{ $badgeColor }}">{{ $p['badge'] }}</div>
                    @endif --}}

                <div class="card-img-wrap">
                    <img src="{{ asset('admin/uploads/' . $category . '/' . $p['image']) ?? '' }}"
                        alt="{{ $p['name'] ?? '' }}" class="card-img" loading="lazy" />
                    <div class="card-overlay">
                        <button class="quick-enq" onclick="openModal('{{ addslashes($p['name']) }}')">Quick
                            Enquiry</button>
                    </div>
                </div>

                <div class="card-body">
                    <h3 class="card-name">{{ $p['name'] ?? '' }}</h3>
                    <p class="card-desc">{{ $p['desc'] ?? '' }}</p>
                    <div class="card-pricing">
                        <span
                            class="market-price">₹{{ number_format($p['market_price'] ?? 0) }}/{{ $p['unit'] ?? '' }}</span>
                        <span class="our-price">₹{{ number_format($p['price'] ?? 0) }}/{{ $p['unit'] ?? '' }}</span>
                    </div>
                    <button class="enq-btn" onclick="openModal('{{ addslashes($p['name']) }}')">Enquiry
                        Now</button>
                </div>
            </div>

        @empty
            <div class="empty-state">
                <p>No products found.</p>
            </div>
        @endforelse

    </div>
</div>



<script>
    // ─── Filter ────────────────────────────────────────────────
    function filterProducts(tag, btn) {
        document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
        btn.classList.add('active');

        const cards = document.querySelectorAll('.product-card');
        let visible = 0;

        cards.forEach(card => {
            const match = tag === 'All' || card.dataset.tag === tag;
            card.style.display = match ? 'block' : 'none';
            if (match) visible++;
        });

        document.getElementById('productCount').textContent = `${visible} Products`;
        checkEmpty(visible);
    }

    // ─── Sort ──────────────────────────────────────────────────
    function sortProducts(value) {
        const grid = document.getElementById('listingGrid');
        const cards = [...grid.querySelectorAll('.product-card')];

        cards.sort((a, b) => {
            if (value === 'price-low') return +a.dataset.price - +b.dataset.price;
            if (value === 'price-high') return +b.dataset.price - +a.dataset.price;
            if (value === 'name') return a.dataset.name.localeCompare(b.dataset.name);
            return 0;
        });

        cards.forEach(card => grid.appendChild(card));
    }

    // ─── Empty state ───────────────────────────────────────────
    function checkEmpty(count) {
        let empty = document.getElementById('emptyState');
        if (count === 0) {
            if (!empty) {
                empty = document.createElement('div');
                empty.id = 'emptyState';
                empty.className = 'empty-state';
                empty.innerHTML = '<p>No products found for this filter.</p>';
                document.getElementById('listingGrid').appendChild(empty);
            }
        } else {
            if (empty) empty.remove();
        }
    }

    // ─── Modal ─────────────────────────────────────────────────
    function openModal(productName) {
        document.getElementById('modalProductName').textContent = productName;
        document.getElementById('modalBackdrop').classList.add('active');
        document.getElementById('enquiryModal').classList.add('active');
        document.getElementById('modalSuccess').classList.remove('show');
        document.querySelector('.modal-submit').style.display = 'block';
        document.querySelector('.modal-header').style.display = 'block';
        document.querySelector('.modal-body').style.display = 'grid';
        document.body.style.overflow = 'hidden';
        document.getElementById('enqMessage').value = `I am interested in: ${productName}`;
    }

    function closeModal() {
        document.getElementById('modalBackdrop').classList.remove('active');
        document.getElementById('enquiryModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    function submitEnquiry() {
        const name = document.getElementById('enqName').value.trim();
        const phone = document.getElementById('enqPhone').value.trim();
        if (!name || !phone) return;
        const btn = document.querySelector('.modal-submit');
        btn.textContent = 'Sending...';
        btn.disabled = true;
        setTimeout(() => {
            btn.style.display = 'none';
            document.querySelector('.modal-header').style.display = 'none';
            document.querySelector('.modal-body').style.display = 'none';
            document.getElementById('modalSuccess').classList.add('show');
            setTimeout(closeModal, 3000);
        }, 1200);
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeModal();
    });

    // ─── Navbar scroll ─────────────────────────────────────────
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => navbar.classList.toggle('scrolled', window.scrollY > 50));
</script>
