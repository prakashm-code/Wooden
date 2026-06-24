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
        /* ===== LISTING PAGE SPECIFIC ===== */
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

        /* ===== FILTER BAR ===== */
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

        /* ===== LISTING BODY ===== */
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

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
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
                <a href="index.html">Home</a>
                <span class="sep">›</span>
                <span class="current" id="breadcrumbCat">Products</span>
            </div>
            <h1>Our <span id="heroTitle">Products</span></h1>
            <p id="heroSubtitle">Browse our complete collection</p>
            <span class="listing-count" id="productCount">0 Products</span>
        </div>
    </div>

    <!-- FILTER BAR -->
    <div class="filter-bar">
        <div class="filter-inner">
            <span class="filter-label">Filter:</span>
            <div class="filter-pills" id="filterPills"></div>
            <select class="filter-sort" id="sortSelect">
                <option value="default">Sort: Default</option>
                <option value="price-low">Price: Low to High</option>
                <option value="price-high">Price: High to Low</option>
                <option value="name">Name: A to Z</option>
            </select>
        </div>
    </div>

    <!-- LISTING GRID -->
    <div class="listing-body">
        <div class="listing-grid" id="listingGrid"></div>
    </div>

    <!-- FOOTER MINI -->
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
            <div class="modal-field"><label>City</label><input type="text" id="enqCity" placeholder="Your city" />
            </div>
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
        // ===== PRODUCT DATA =====
        const allProducts = {
            plywoods: {
                title: 'Plywoods',
                subtitle: 'Engineered for strength, finished for beauty',
                filters: ['All', 'BWP 710', 'MR Grade', 'Fire Retardant', 'Calibrated', 'Premium'],
                items: [{
                        id: 1,
                        name: 'Marine Plywood BWP 710',
                        desc: '100% Waterproof · 19mm · Gurjan Face',
                        market: 4800,
                        price: 3999,
                        unit: 'sheet',
                        badge: 'Best Seller',
                        tag: 'BWP 710',
                        img: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=280&fit=crop'
                    },
                    {
                        id: 2,
                        name: 'Fire Retardant Plywood',
                        desc: 'FR Grade · 12mm · ISI Marked',
                        market: 5200,
                        price: 4299,
                        unit: 'sheet',
                        badge: 'New',
                        tag: 'Fire Retardant',
                        img: 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=400&h=280&fit=crop'
                    },
                    {
                        id: 3,
                        name: 'Commercial Plywood MR Grade',
                        desc: 'Moisture Resistant · 18mm · Eucalyptus Core',
                        market: 3100,
                        price: 2499,
                        unit: 'sheet',
                        badge: '',
                        tag: 'MR Grade',
                        img: 'https://images.unsplash.com/photo-1567016432779-094069958ea5?w=400&h=280&fit=crop'
                    },
                    {
                        id: 4,
                        name: 'Calibrated Plywood Premium',
                        desc: '±0.5mm Tolerance · 25mm · Sanded Both Sides',
                        market: 6500,
                        price: 5199,
                        unit: 'sheet',
                        badge: 'Hot Deal',
                        tag: 'Calibrated',
                        img: 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=400&h=280&fit=crop'
                    },
                    {
                        id: 5,
                        name: 'BWP 710 Waterproof Ply 12mm',
                        desc: 'Boiling Water Proof · 12mm · Pine Face',
                        market: 3800,
                        price: 2999,
                        unit: 'sheet',
                        badge: '',
                        tag: 'BWP 710',
                        img: 'https://images.unsplash.com/photo-1516455590571-18256e5bb9ff?w=400&h=280&fit=crop'
                    },
                    {
                        id: 6,
                        name: 'Termite Proof Plywood 18mm',
                        desc: 'Anti-Termite · 18mm · Both Sides Sanded',
                        market: 4200,
                        price: 3499,
                        unit: 'sheet',
                        badge: 'Premium',
                        tag: 'Premium',
                        img: 'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=400&h=280&fit=crop'
                    },
                    {
                        id: 7,
                        name: 'Eco Plywood Zero Emission',
                        desc: 'Zero Formaldehyde · 15mm · Eco Certified',
                        market: 4600,
                        price: 3799,
                        unit: 'sheet',
                        badge: '',
                        tag: 'Premium',
                        img: 'https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=400&h=280&fit=crop'
                    },
                    {
                        id: 8,
                        name: 'Gurjan Core BWP Plywood',
                        desc: 'Gurjan Hardwood Core · 25mm · ISI Certified',
                        market: 7200,
                        price: 5999,
                        unit: 'sheet',
                        badge: 'Premium',
                        tag: 'BWP 710',
                        img: 'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?w=400&h=280&fit=crop'
                    },
                ]
            },
            blockboard: {
                title: 'Blockboard',
                subtitle: 'The backbone of every great furniture piece',
                filters: ['All', 'Teak', 'Pine Core', 'MDF Core', 'BWR', 'Premium'],
                items: [{
                        id: 1,
                        name: 'Teak Blockboard 25mm',
                        desc: 'Natural Teak Veneer · Screw Holding Strength',
                        market: 5500,
                        price: 4599,
                        unit: 'sheet',
                        badge: 'Premium',
                        tag: 'Teak',
                        img: 'https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=400&h=280&fit=crop'
                    },
                    {
                        id: 2,
                        name: 'Pine Core Blockboard',
                        desc: 'Lightweight · 19mm · Ideal for Doors & Panels',
                        market: 4200,
                        price: 3499,
                        unit: 'sheet',
                        badge: '',
                        tag: 'Pine Core',
                        img: 'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?w=400&h=280&fit=crop'
                    },
                    {
                        id: 3,
                        name: 'MDF Core Blockboard',
                        desc: 'Smooth Finish · 25mm · Zero Formaldehyde',
                        market: 4800,
                        price: 3899,
                        unit: 'sheet',
                        badge: 'New',
                        tag: 'MDF Core',
                        img: 'https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=400&h=280&fit=crop'
                    },
                    {
                        id: 4,
                        name: 'Eucalyptus Blockboard BWR',
                        desc: 'Water Resistant · 19mm · Long Life Guarantee',
                        market: 3800,
                        price: 2999,
                        unit: 'sheet',
                        badge: 'Hot Deal',
                        tag: 'BWR',
                        img: 'https://images.unsplash.com/photo-1484101403633-562f891dc89a?w=400&h=280&fit=crop'
                    },
                    {
                        id: 5,
                        name: 'Premium Teak Blockboard 19mm',
                        desc: 'Smooth Teak Face · 19mm · Furniture Grade',
                        market: 4900,
                        price: 4099,
                        unit: 'sheet',
                        badge: 'Premium',
                        tag: 'Teak',
                        img: 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=400&h=280&fit=crop'
                    },
                    {
                        id: 6,
                        name: 'Hardwood Core Blockboard 25mm',
                        desc: 'Dense Hardwood Core · 25mm · Warp Free',
                        market: 5200,
                        price: 4299,
                        unit: 'sheet',
                        badge: '',
                        tag: 'Premium',
                        img: 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=400&h=280&fit=crop'
                    },
                ]
            },
            doors: {
                title: 'Doors',
                subtitle: 'Where first impressions are crafted in wood',
                filters: ['All', 'Flush Door', 'Panel Door', 'WPC', 'Membrane', 'Designer'],
                items: [{
                        id: 1,
                        name: 'Flush Door – Solid Core',
                        desc: 'Solid Core · 35mm · Pre-laminated Finish',
                        market: 8500,
                        price: 6999,
                        unit: 'door',
                        badge: 'Top Pick',
                        tag: 'Flush Door',
                        img: 'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=400&h=280&fit=crop'
                    },
                    {
                        id: 2,
                        name: 'Designer Panel Door – Walnut',
                        desc: 'Walnut Veneer · 40mm · Panel Design',
                        market: 12000,
                        price: 9499,
                        unit: 'door',
                        badge: 'Trending',
                        tag: 'Panel Door',
                        img: 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?w=400&h=280&fit=crop'
                    },
                    {
                        id: 3,
                        name: 'WPC Door – Waterproof',
                        desc: '100% Waterproof · 35mm · Bathroom Grade',
                        market: 7000,
                        price: 5499,
                        unit: 'door',
                        badge: '',
                        tag: 'WPC',
                        img: 'https://images.unsplash.com/photo-1502005229762-cf1b2da7c5d6?w=400&h=280&fit=crop'
                    },
                    {
                        id: 4,
                        name: 'Membrane Door – High Gloss',
                        desc: 'PVC Membrane · 32mm · Scratch Resistant',
                        market: 9500,
                        price: 7299,
                        unit: 'door',
                        badge: 'Best Value',
                        tag: 'Membrane',
                        img: 'https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=400&h=280&fit=crop'
                    },
                    {
                        id: 5,
                        name: 'Teak Panel Door Premium',
                        desc: 'Real Teak Wood · 40mm · Classic Design',
                        market: 15000,
                        price: 11999,
                        unit: 'door',
                        badge: 'Premium',
                        tag: 'Panel Door',
                        img: 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=280&fit=crop'
                    },
                    {
                        id: 6,
                        name: 'Hollow Core Flush Door',
                        desc: 'Lightweight · 30mm · Budget Friendly',
                        market: 5500,
                        price: 3999,
                        unit: 'door',
                        badge: '',
                        tag: 'Flush Door',
                        img: 'https://images.unsplash.com/photo-1567016432779-094069958ea5?w=400&h=280&fit=crop'
                    },
                    {
                        id: 7,
                        name: 'Designer Groove Door',
                        desc: 'CNC Groove Pattern · 35mm · Modern Look',
                        market: 11000,
                        price: 8499,
                        unit: 'door',
                        badge: 'New',
                        tag: 'Designer',
                        img: 'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=400&h=280&fit=crop'
                    },
                    {
                        id: 8,
                        name: 'WPC Bathroom Door Matte',
                        desc: 'Zero Moisture Absorption · 30mm · Matt Finish',
                        market: 6800,
                        price: 4999,
                        unit: 'door',
                        badge: '',
                        tag: 'WPC',
                        img: 'https://images.unsplash.com/photo-1516455590571-18256e5bb9ff?w=400&h=280&fit=crop'
                    },
                ]
            }
        };

        // ===== INIT =====
        const params = new URLSearchParams(window.location.search);
        const cat = params.get('cat') || 'plywoods';
        const data = allProducts[cat] || allProducts.plywoods;
        let activeFilter = 'All';

        // Set page text
        document.getElementById('heroTitle').textContent = data.title;
        document.getElementById('heroSubtitle').textContent = data.subtitle;
        document.getElementById('breadcrumbCat').textContent = data.title;
        document.title = `${data.title} – WoodCraft Premium`;

        // Build filter pills
        const pillsContainer = document.getElementById('filterPills');
        data.filters.forEach(f => {
            const btn = document.createElement('button');
            btn.className = 'filter-pill' + (f === 'All' ? ' active' : '');
            btn.textContent = f;
            btn.onclick = () => {
                activeFilter = f;
                document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
                btn.classList.add('active');
                renderProducts();
            };
            pillsContainer.appendChild(btn);
        });

        // Sort
        document.getElementById('sortSelect').onchange = renderProducts;

        function renderProducts() {
            let items = [...data.items];
            if (activeFilter !== 'All') items = items.filter(p => p.tag === activeFilter);

            const sort = document.getElementById('sortSelect').value;
            if (sort === 'price-low') items.sort((a, b) => a.price - b.price);
            else if (sort === 'price-high') items.sort((a, b) => b.price - a.price);
            else if (sort === 'name') items.sort((a, b) => a.name.localeCompare(b.name));

            document.getElementById('productCount').textContent = `${items.length} Products`;

            const grid = document.getElementById('listingGrid');
            grid.innerHTML = '';

            if (items.length === 0) {
                grid.innerHTML =
                    '<div class="empty-state" style="grid-column:1/-1"><p>No products found for this filter.</p></div>';
                return;
            }

            items.forEach((p, i) => {
                const badgeColor = p.badge === 'Best Seller' || p.badge === 'Top Pick' ? 'var(--red)' :
                    p.badge === 'New' || p.badge === 'Trending' ? '#16a34a' :
                    p.badge === 'Hot Deal' || p.badge === 'Best Value' ? 'var(--orange)' : 'var(--red)';

                const card = document.createElement('div');
                card.className = 'product-card reveal';
                card.style.animationDelay = `${i * 60}ms`;
                card.innerHTML = `
      ${p.badge ? `<div class="card-badge" style="background:${badgeColor}">${p.badge}</div>` : ''}
      <div class="card-img-wrap">
        <img src="${p.img}" alt="${p.name}" class="card-img" loading="lazy"/>
        <div class="card-overlay">
          <button class="quick-enq" onclick="openModal('${p.name}')">Quick Enquiry</button>
        </div>
      </div>
      <div class="card-body">
        <h3 class="card-name">${p.name}</h3>
        <p class="card-desc">${p.desc}</p>
        <div class="card-pricing">
          <span class="market-price">₹${p.market.toLocaleString()}/${p.unit}</span>
          <span class="our-price">₹${p.price.toLocaleString()}/${p.unit}</span>
        </div>
        <button class="enq-btn" onclick="openModal('${p.name}')">Enquiry Now</button>
      </div>
    `;
                grid.appendChild(card);
            });

            // Animate
            setTimeout(() => {
                document.querySelectorAll('.reveal').forEach(el => el.classList.add('visible'));
            }, 50);
        }

        renderProducts();

        // ===== MODAL (same as home) =====
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

        // Navbar scroll
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => navbar.classList.toggle('scrolled', window.scrollY > 50));
    </script>
</body>

</html>
