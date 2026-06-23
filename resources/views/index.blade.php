<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>WoodCraft Premium – India's Finest Plywood</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet"/>  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"/>
</head>
<body>
<div class="page-loader" id="pageLoader">
  <div class="loader-logo">Wood<span>Craft</span> Premium</div>
  <div class="loader-bar-wrap">
    <div class="loader-bar"></div>
  </div>
</div>
<!-- ========== NAVBAR ========== -->
<nav class="navbar" id="navbar">
  <div class="nav-container">
    <div class="logo">
      <span class="logo-icon">🪵</span>
      <div>
        <span class="logo-main">WoodCraft</span>
        <span class="logo-sub">Premium</span>
      </div>
    </div>
    <ul class="nav-links">
      <li><a href="#plywoods">Plywoods</a></li>
      <li><a href="{{ route('listing') }}">Blockboard</a></li>
      <li><a href="#doors">Doors</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#contact" class="nav-cta">Contact Us</a></li>
    </ul>
    <div class="nav-phone">📞 1800-000-1234</div>
    <button class="hamburger" id="hamburger">☰</button>
  </div>
</nav>

<!-- ========== HERO ========== -->
<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <div class="hero-text">
      <p class="hero-eyebrow">India's Most Trusted</p>
      <h1 class="hero-title">
        Premium<br/>
        <span class="hero-accent">Plywood</span><br/>
        Crafted to Last
      </h1>
      <p class="hero-sub">100+ Quality Tests · BIS Certified · 30-Year Warranty</p>
      <div class="hero-badges">
        <div class="badge">✅ Waterproof</div>
        <div class="badge">✅ Termite Proof</div>
        <div class="badge">✅ Fire Retardant</div>
      </div>
      <a href="#plywoods" class="hero-btn">Explore Products</a>
    </div>
    <div class="hero-form">
      <div class="form-card">
        <h3>Get a Free Quote</h3>
        <p>Our experts will reach out to you</p>
        <input type="text" placeholder="Your Name" class="form-input"/>
        <input type="tel" placeholder="Phone Number" class="form-input"/>
        <input type="email" placeholder="Email Address" class="form-input"/>
        <select class="form-input">
          <option value="">Select State</option>
          <option>Gujarat</option>
          <option>Maharashtra</option>
          <option>Rajasthan</option>
          <option>Delhi</option>
          <option>Karnataka</option>
        </select>
        <textarea placeholder="Message (optional)" class="form-input form-textarea"></textarea>
        <button class="form-submit">Get Quote Now →</button>
      </div>
    </div>
  </div>
  <div class="hero-scroll">
    <div class="scroll-dot"></div>
  </div>
</section>

<!-- ========== FEATURES STRIP ========== -->
<section class="features-strip">
  <div class="strip-container">
    <div class="strip-item"><span class="strip-icon">💧</span><span>Boiling Waterproof</span></div>
    <div class="strip-item"><span class="strip-icon">🔥</span><span>Fire Retardant</span></div>
    <div class="strip-item"><span class="strip-icon">🪲</span><span>Termite Proof</span></div>
    <div class="strip-item"><span class="strip-icon">🏆</span><span>30-Year Warranty</span></div>
    <div class="strip-item"><span class="strip-icon">🌱</span><span>Eco Compliant</span></div>
    <div class="strip-item"><span class="strip-icon">✅</span><span>BIS Certified</span></div>
  </div>
</section>

<!-- ========== PLYWOODS SECTION ========== -->
<section class="product-section" id="plywoods">
  <div class="section-container">
    <div class="section-header reveal">
      {{-- <p class="section-eyebrow">Category 01</p> --}}
      <h2 class="section-title">Plywoods</h2>
      <p class="section-sub">Engineered for strength, finished for beauty</p>
      <div class="section-line"></div>
    </div>
    <div class="product-grid">

      <div class="product-card reveal">
        <div class="card-badge">Best Seller</div>
        <div class="card-img-wrap">
          <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=280&fit=crop" alt="Marine Plywood" class="card-img"/>
          <div class="card-overlay">
            <button class="quick-enq" onclick="openModal('Marine Plywood BWP 710')">Quick Enquiry</button>
          </div>
        </div>
        <div class="card-body">
          <h3 class="card-name">Marine Plywood BWP 710</h3>
          <p class="card-desc">100% waterproof · 19mm · Gurjan Face</p>
          <div class="card-pricing">
            <span class="market-price">₹4,800/sheet</span>
            <span class="our-price">₹3,999/sheet</span>
          </div>
          <button class="enq-btn" onclick="openModal('Marine Plywood BWP 710')">Enquiry Now</button>
        </div>
      </div>

      <div class="product-card reveal">
        <div class="card-badge new">New Arrival</div>
        <div class="card-img-wrap">
          <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=400&h=280&fit=crop" alt="Fire Retardant Ply" class="card-img"/>
          <div class="card-overlay">
            <button class="quick-enq" onclick="openModal('Fire Retardant Plywood')">Quick Enquiry</button>
          </div>
        </div>
        <div class="card-body">
          <h3 class="card-name">Fire Retardant Plywood</h3>
          <p class="card-desc">FR Grade · 12mm · ISI Marked</p>
          <div class="card-pricing">
            <span class="market-price">₹5,200/sheet</span>
            <span class="our-price">₹4,299/sheet</span>
          </div>
          <button class="enq-btn" onclick="openModal('Fire Retardant Plywood')">Enquiry Now</button>
        </div>
      </div>

      <div class="product-card reveal">
        <div class="card-img-wrap">
          <img src="https://images.unsplash.com/photo-1567016432779-094069958ea5?w=400&h=280&fit=crop" alt="Commercial Plywood" class="card-img"/>
          <div class="card-overlay">
            <button class="quick-enq" onclick="openModal('Commercial Plywood MR Grade')">Quick Enquiry</button>
          </div>
        </div>
        <div class="card-body">
          <h3 class="card-name">Commercial Plywood MR Grade</h3>
          <p class="card-desc">Moisture Resistant · 18mm · Eucalyptus Core</p>
          <div class="card-pricing">
            <span class="market-price">₹3,100/sheet</span>
            <span class="our-price">₹2,499/sheet</span>
          </div>
          <button class="enq-btn" onclick="openModal('Commercial Plywood MR Grade')">Enquiry Now</button>
        </div>
      </div>

      <div class="product-card reveal">
        <div class="card-badge hot">Hot Deal</div>
        <div class="card-img-wrap">
          <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=400&h=280&fit=crop" alt="Calibrated Plywood" class="card-img"/>
          <div class="card-overlay">
            <button class="quick-enq" onclick="openModal('Calibrated Plywood Premium')">Quick Enquiry</button>
          </div>
        </div>
        <div class="card-body">
          <h3 class="card-name">Calibrated Plywood Premium</h3>
          <p class="card-desc">±0.5mm Tolerance · 25mm · Sanded Both Sides</p>
          <div class="card-pricing">
            <span class="market-price">₹6,500/sheet</span>
            <span class="our-price">₹5,199/sheet</span>
          </div>
          <button class="enq-btn" onclick="openModal('Calibrated Plywood Premium')">Enquiry Now</button>
        </div>
      </div>

    </div>
    <div class="see-all-wrap reveal">
      <a href="listing.html?cat=plywoods" class="see-all-btn">See All Plywoods <span>→</span></a>
    </div>
  </div>
</section>

<!-- ========== BLOCKBOARD SECTION ========== -->
<section class="product-section alt-bg" id="blockboard">
  <div class="section-container">
    <div class="section-header reveal">
      {{-- <p class="section-eyebrow">Category 02</p> --}}
      <h2 class="section-title">Blockboard</h2>
      <p class="section-sub">The backbone of every great furniture piece</p>
      <div class="section-line"></div>
    </div>
    <div class="product-grid">

      <div class="product-card reveal">
        <div class="card-badge">Premium</div>
        <div class="card-img-wrap">
          <img src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=400&h=280&fit=crop" alt="Teak Blockboard" class="card-img"/>
          <div class="card-overlay">
            <button class="quick-enq" onclick="openModal('Teak Blockboard 25mm')">Quick Enquiry</button>
          </div>
        </div>
        <div class="card-body">
          <h3 class="card-name">Teak Blockboard 25mm</h3>
          <p class="card-desc">Natural Teak Veneer · Screw Holding Strength</p>
          <div class="card-pricing">
            <span class="market-price">₹5,500/sheet</span>
            <span class="our-price">₹4,599/sheet</span>
          </div>
          <button class="enq-btn" onclick="openModal('Teak Blockboard 25mm')">Enquiry Now</button>
        </div>
      </div>

      <div class="product-card reveal">
        <div class="card-img-wrap">
          <img src="https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?w=400&h=280&fit=crop" alt="Pine Blockboard" class="card-img"/>
          <div class="card-overlay">
            <button class="quick-enq" onclick="openModal('Pine Core Blockboard')">Quick Enquiry</button>
          </div>
        </div>
        <div class="card-body">
          <h3 class="card-name">Pine Core Blockboard</h3>
          <p class="card-desc">Lightweight · 19mm · Ideal for Doors & Panels</p>
          <div class="card-pricing">
            <span class="market-price">₹4,200/sheet</span>
            <span class="our-price">₹3,499/sheet</span>
          </div>
          <button class="enq-btn" onclick="openModal('Pine Core Blockboard')">Enquiry Now</button>
        </div>
      </div>

      <div class="product-card reveal">
        <div class="card-badge new">New</div>
        <div class="card-img-wrap">
          <img src="https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=400&h=280&fit=crop" alt="MDF Blockboard" class="card-img"/>
          <div class="card-overlay">
            <button class="quick-enq" onclick="openModal('MDF Core Blockboard')">Quick Enquiry</button>
          </div>
        </div>
        <div class="card-body">
          <h3 class="card-name">MDF Core Blockboard</h3>
          <p class="card-desc">Smooth Finish · 25mm · Zero Formaldehyde</p>
          <div class="card-pricing">
            <span class="market-price">₹4,800/sheet</span>
            <span class="our-price">₹3,899/sheet</span>
          </div>
          <button class="enq-btn" onclick="openModal('MDF Core Blockboard')">Enquiry Now</button>
        </div>
      </div>

      <div class="product-card reveal">
        <div class="card-badge hot">Hot Deal</div>
        <div class="card-img-wrap">
          <img src="https://images.unsplash.com/photo-1484101403633-562f891dc89a?w=400&h=280&fit=crop" alt="Eucalyptus Blockboard" class="card-img"/>
          <div class="card-overlay">
            <button class="quick-enq" onclick="openModal('Eucalyptus Blockboard BWR')">Quick Enquiry</button>
          </div>
        </div>
        <div class="card-body">
          <h3 class="card-name">Eucalyptus Blockboard BWR</h3>
          <p class="card-desc">Water Resistant · 19mm · Long Life Guarantee</p>
          <div class="card-pricing">
            <span class="market-price">₹3,800/sheet</span>
            <span class="our-price">₹2,999/sheet</span>
          </div>
          <button class="enq-btn" onclick="openModal('Eucalyptus Blockboard BWR')">Enquiry Now</button>
        </div>
      </div>

    </div>
    <div class="see-all-wrap reveal">
      <a href="listing.html?cat=blockboard" class="see-all-btn">See All Blockboards <span>→</span></a>
    </div>
  </div>
</section>

<!-- ========== DOORS SECTION ========== -->
<section class="product-section" id="doors">
  <div class="section-container">
    <div class="section-header reveal">
      {{-- <p class="section-eyebrow">Category 03</p> --}}
      <h2 class="section-title">Doors</h2>
      <p class="section-sub">Where first impressions are crafted in wood</p>
      <div class="section-line"></div>
    </div>
    <div class="product-grid">

      <div class="product-card reveal">
        <div class="card-badge">Top Pick</div>
        <div class="card-img-wrap">
          <img src="https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=400&h=280&fit=crop" alt="Flush Door" class="card-img"/>
          <div class="card-overlay">
            <button class="quick-enq" onclick="openModal('Flush Door – Solid Core')">Quick Enquiry</button>
          </div>
        </div>
        <div class="card-body">
          <h3 class="card-name">Flush Door – Solid Core</h3>
          <p class="card-desc">Solid Core · 35mm · Pre-laminated Finish</p>
          <div class="card-pricing">
            <span class="market-price">₹8,500/door</span>
            <span class="our-price">₹6,999/door</span>
          </div>
          <button class="enq-btn" onclick="openModal('Flush Door – Solid Core')">Enquiry Now</button>
        </div>
      </div>

      <div class="product-card reveal">
        <div class="card-badge new">Trending</div>
        <div class="card-img-wrap">
          <img src="https://images.unsplash.com/photo-1600566752355-35792bedcfea?w=400&h=280&fit=crop" alt="Designer Panel Door" class="card-img"/>
          <div class="card-overlay">
            <button class="quick-enq" onclick="openModal('Designer Panel Door – Walnut')">Quick Enquiry</button>
          </div>
        </div>
        <div class="card-body">
          <h3 class="card-name">Designer Panel Door – Walnut</h3>
          <p class="card-desc">Walnut Veneer · 40mm · Panel Design</p>
          <div class="card-pricing">
            <span class="market-price">₹12,000/door</span>
            <span class="our-price">₹9,499/door</span>
          </div>
          <button class="enq-btn" onclick="openModal('Designer Panel Door – Walnut')">Enquiry Now</button>
        </div>
      </div>

      <div class="product-card reveal">
        <div class="card-img-wrap">
          <img src="https://images.unsplash.com/photo-1502005229762-cf1b2da7c5d6?w=400&h=280&fit=crop" alt="WPC Door" class="card-img"/>
          <div class="card-overlay">
            <button class="quick-enq" onclick="openModal('WPC Door – Waterproof')">Quick Enquiry</button>
          </div>
        </div>
        <div class="card-body">
          <h3 class="card-name">WPC Door – Waterproof</h3>
          <p class="card-desc">100% Waterproof · 35mm · Bathroom Grade</p>
          <div class="card-pricing">
            <span class="market-price">₹7,000/door</span>
            <span class="our-price">₹5,499/door</span>
          </div>
          <button class="enq-btn" onclick="openModal('WPC Door – Waterproof')">Enquiry Now</button>
        </div>
      </div>

      <div class="product-card reveal">
        <div class="card-badge hot">Best Value</div>
        <div class="card-img-wrap">
          <img src="https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=400&h=280&fit=crop" alt="Membrane Door" class="card-img"/>
          <div class="card-overlay">
            <button class="quick-enq" onclick="openModal('Membrane Door – High Gloss')">Quick Enquiry</button>
          </div>
        </div>
        <div class="card-body">
          <h3 class="card-name">Membrane Door – High Gloss</h3>
          <p class="card-desc">PVC Membrane · 32mm · Scratch Resistant</p>
          <div class="card-pricing">
            <span class="market-price">₹9,500/door</span>
            <span class="our-price">₹7,299/door</span>
          </div>
          <button class="enq-btn" onclick="openModal('Membrane Door – High Gloss')">Enquiry Now</button>
        </div>
      </div>

    </div>
    <div class="see-all-wrap reveal">
      <a href="listing.html?cat=doors" class="see-all-btn">See All Doors <span>→</span></a>
    </div>
  </div>
</section>

<!-- ========== WHY CHOOSE US ========== -->
<section class="why-us">
  <div class="section-container">
    <div class="section-header reveal">
      <h2 class="section-title light">Why Choose WoodCraft?</h2>
      <div class="section-line light-line"></div>
    </div>
    <div class="why-grid">
      <div class="why-card reveal">
        <div class="why-icon">🏅</div>
        <h3>30+ Years Experience</h3>
        <p>Trusted by 50,000+ families across India</p>
      </div>
      <div class="why-card reveal">
        <div class="why-icon">🔬</div>
        <h3>100+ Quality Tests</h3>
        <p>Every sheet passes rigorous quality checks</p>
      </div>
      <div class="why-card reveal">
        <div class="why-icon">🚚</div>
        <h3>Pan India Delivery</h3>
        <p>Delivering to 500+ cities across India</p>
      </div>
      <div class="why-card reveal">
        <div class="why-icon">📞</div>
        <h3>Expert Support</h3>
        <p>Free consultation with wood experts</p>
      </div>
    </div>
  </div>
</section>

<!-- ========== TESTIMONIALS ========== -->
<section class="testimonials" id="about">
  <div class="section-container">
    <div class="section-header reveal">
      <h2 class="section-title">What Our Customers Say</h2>
      <div class="section-line"></div>
    </div>
    <div class="testi-grid">
      <div class="testi-card reveal">
        <div class="testi-stars">★★★★★</div>
        <p>"Excellent quality plywood. Used for my entire home interior. Very happy with the finish and durability."</p>
        <div class="testi-author">
          <div class="testi-avatar">R</div>
          <div><strong>Rajesh Patel</strong><span>Ahmedabad, Gujarat</span></div>
        </div>
      </div>
      <div class="testi-card reveal">
        <div class="testi-stars">★★★★★</div>
        <p>"The blockboard quality is outstanding. My carpenter was very impressed. Highly recommended for furniture work."</p>
        <div class="testi-author">
          <div class="testi-avatar">S</div>
          <div><strong>Sunita Sharma</strong><span>Mumbai, Maharashtra</span></div>
        </div>
      </div>
      <div class="testi-card reveal">
        <div class="testi-stars">★★★★☆</div>
        <p>"Got the fire retardant ply for my modular kitchen. Great product, fast delivery and good pricing."</p>
        <div class="testi-author">
          <div class="testi-avatar">A</div>
          <div><strong>Amit Verma</strong><span>Delhi</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========== FOOTER ========== -->
<footer class="footer" id="contact">
  <div class="footer-container">
    <div class="footer-brand">
      <div class="logo">
        <span class="logo-icon">🪵</span>
        <div>
          <span class="logo-main" style="color:#fff">WoodCraft</span>
          <span class="logo-sub" style="color:#e87c2e">Premium</span>
        </div>
      </div>
      <p>India's most trusted plywood brand since 1992. Quality you can feel, durability you can trust.</p>
      <div class="footer-social">
        <a href="#">FB</a><a href="#">IG</a><a href="#">YT</a>
      </div>
    </div>
    <div class="footer-links">
      <h4>Products</h4>
      <ul>
        <li><a href="listing.html?cat=plywoods">Plywoods</a></li>
        <li><a href="listing.html?cat=blockboard">Blockboard</a></li>
        <li><a href="listing.html?cat=doors">Doors</a></li>
      </ul>
    </div>
    <div class="footer-links">
      <h4>Company</h4>
      <ul>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Certificates</a></li>
        <li><a href="#">Dealers Near You</a></li>
        <li><a href="#">Privacy Policy</a></li>
      </ul>
    </div>
    <div class="footer-contact">
      <h4>Contact Us</h4>
      <p>📞 Toll Free: 1800-000-1234</p>
      <p>📧 info@woodcraftpremium.in</p>
      <p>📍 Ahmedabad, Gujarat</p>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2025 WoodCraft Premium. All Rights Reserved. | Terms & Conditions | Privacy Policy</p>
  </div>
</footer>

<!-- ========== ENQUIRY MODAL ========== -->
<div class="modal-backdrop" id="modalBackdrop" onclick="closeModal()"></div>
<div class="modal" id="enquiryModal">
  <button class="modal-close" onclick="closeModal()">✕</button>
  <div class="modal-header">
    <div class="modal-icon">📩</div>
    <h2>Enquiry Now</h2>
    <p id="modalProductName" class="modal-product-tag"></p>
  </div>
  <div class="modal-body">
    <div class="modal-field">
      <label>Your Name *</label>
      <input type="text" id="enqName" placeholder="Enter your full name"/>
    </div>
    <div class="modal-field">
      <label>Phone Number *</label>
      <input type="tel" id="enqPhone" placeholder="+91 00000 00000"/>
    </div>
    <div class="modal-field">
      <label>Email Address</label>
      <input type="email" id="enqEmail" placeholder="your@email.com"/>
    </div>
    <div class="modal-field">
      <label>City</label>
      <input type="text" id="enqCity" placeholder="Your city"/>
    </div>
    <div class="modal-field full">
      <label>Message</label>
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

<script src="{{ asset('assets/js/index.js') }}"></script>
</body>
</html>
