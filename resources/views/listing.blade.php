<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Listing – WoodCraft Premium</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <style>
        .listing-hero {
            padding: 120px 0 60px;
            background: linear-gradient(135deg, #1a0a00 0%, #3d1a00 60%, #8B5E3C 100%);
            position: relative;
            overflow: hidden;
        }

        .listing-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1400') center/cover;
            opacity: 0.15;
        }

        .listing-hero-inner {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
        }

        .listing-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .listing-breadcrumb a,
        .listing-breadcrumb span {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            transition: color 0.3s;
        }

        .listing-breadcrumb a:hover {
            color: #fff;
        }

        .listing-breadcrumb .sep {
            color: rgba(255, 255, 255, 0.3);
        }

        .listing-breadcrumb .current {
            color: #fff;
            font-weight: 600;
        }

        .listing-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3.5rem);
            font-weight: 800;
            color: #fff;
            margin-bottom: 0.75rem;
        }

        .listing-hero h1 span {
            color: var(--red);
        }

        .listing-hero p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
        }

        .listing-count {
            display: inline-block;
            margin-top: 1rem;
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            padding: 0.35rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .filter-bar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 72px;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        }

        .filter-inner {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 2rem;
            height: 60px;
            display: flex;
            align-items: center;
            gap: 1rem;
            overflow-x: auto;
        }

        .filter-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--gray);
            white-space: nowrap;
        }

        .filter-pills {
            display: flex;
            gap: 0.5rem;
        }

        .filter-pill {
            padding: 0.35rem 1rem;
            border: 1.5px solid #e5e7eb;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--gray);
            cursor: pointer;
            transition: all 0.25s;
            white-space: nowrap;
            background: #fff;
        }

        .filter-pill:hover,
        .filter-pill.active {
            border-color: var(--red);
            color: var(--red);
            background: var(--red-light);
        }

        .filter-sort {
            margin-left: auto;
            padding: 0.35rem 0.8rem;
            border: 1.5px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.8rem;
            color: var(--dark);
            cursor: pointer;
            outline: none;
            font-family: 'Inter', sans-serif;
            background: #fff;
        }

        .listing-body {
            max-width: 1300px;
            margin: 0 auto;
            padding: 3rem 2rem 5rem;
        }

        .listing-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .product-card {
            display: none;
        }

        .product-card.visible {
            display: block;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            grid-column: 1 / -1;
        }

        .empty-state p {
            color: var(--gray);
            font-size: 1rem;
        }

        @media (max-width: 1100px) {
            .listing-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .listing-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            .listing-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo" style="text-decoration:none">
                <span class="logo-icon">🪵</span>
                <div>
                    <span class="logo-main">WoodCraft</span>
                    <span class="logo-sub">Premium</span>
                </div>
            </a>
            <ul class="nav-links">
                <li><a href="index.html#plywoods">Plywoods</a></li>
                <li><a href="index.html#blockboard">Blockboard</a></li>
                <li><a href="index.html#doors">Doors</a></li>
                <li><a href="index.html#about">About</a></li>
                <li><a href="index.html#contact" class="nav-cta">Contact Us</a></li>
            </ul>
            <div class="nav-phone">📞 1800-000-1234</div>
        </div>
    </nav>

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
                            <span
                                class="our-price">₹{{ number_format($p['price'] ?? 0) }}/{{ $p['unit'] ?? '' }}</span>
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

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-bottom" style="border-top:none; padding: 2rem;">
            <p>© 2025 WoodCraft Premium. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- MODAL -->
    <div class="modal-backdrop" id="modalBackdrop" onclick="closeModal()"></div>
    <div class="modal" id="enquiryModal">
        <button class="modal-close" onclick="closeModal()">✕</button>
        <div class="modal-header">
            <div class="modal-icon">📩</div>
            <h2>Enquiry Now</h2>
            <p id="modalProductName" class="modal-product-tag"></p>
        </div>
        <div class="modal-body">
            <div class="modal-field"><label>Your Name *</label><input type="text" id="enqName"
                    placeholder="Full name" /></div>
            <div class="modal-field"><label>Phone Number *</label><input type="tel" id="enqPhone"
                    placeholder="+91 00000 00000" /></div>
            <div class="modal-field"><label>Email Address</label><input type="email" id="enqEmail"
                    placeholder="your@email.com" /></div>
            <div class="modal-field"><label>City</label><input type="text" id="enqCity"
                    placeholder="Your city" /></div>
            <div class="modal-field full"><label>Message</label>
                <textarea id="enqMessage" placeholder="Tell us about your requirements..."></textarea>
            </div>
        </div>
        <button class="modal-submit" onclick="submitEnquiry()">Send Enquiry →</button>
        <div class="modal-success" id="modalSuccess">
            <div class="success-icon">✅</div>
            <h3>Enquiry Sent!</h3>
            <p>Our team will contact you within 24 hours.</p>
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

</body>

</html>
