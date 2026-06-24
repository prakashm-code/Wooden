<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WoodCraft Premium – India's Finest Plywood</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
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
            @if ($settings->phone)
                <div class="nav-phone">📞 {{ $settings->phone }}</div>
            @endif
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
                    Premium<br />
                    <span class="hero-accent">Plywood</span><br />
                    Crafted to Last
                </h1>
                <p class="hero-sub">100+ Quality Tests · BIS Certified · 30-Year Warranty</p>
                <div class="hero-badges">
                    <div class="badge"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            fill="#32a852" viewBox="0 0 256 256">
                            <path
                                d="M225.86,102.82c-3.77-3.94-7.67-8-9.14-11.57-1.36-3.27-1.44-8.69-1.52-13.94-.15-9.76-.31-20.82-8-28.51s-18.75-7.85-28.51-8c-5.25-.08-10.67-.16-13.94-1.52-3.56-1.47-7.63-5.37-11.57-9.14C146.28,23.51,138.44,16,128,16s-18.27,7.51-25.18,14.14c-3.94,3.77-8,7.67-11.57,9.14C88,40.64,82.56,40.72,77.31,40.8c-9.76.15-20.82.31-28.51,8S41,67.55,40.8,77.31c-.08,5.25-.16,10.67-1.52,13.94-1.47,3.56-5.37,7.63-9.14,11.57C23.51,109.72,16,117.56,16,128s7.51,18.27,14.14,25.18c3.77,3.94,7.67,8,9.14,11.57,1.36,3.27,1.44,8.69,1.52,13.94.15,9.76.31,20.82,8,28.51s18.75,7.85,28.51,8c5.25.08,10.67.16,13.94,1.52,3.56,1.47,7.63,5.37,11.57,9.14C109.72,232.49,117.56,240,128,240s18.27-7.51,25.18-14.14c3.94-3.77,8-7.67,11.57-9.14,3.27-1.36,8.69-1.44,13.94-1.52,9.76-.15,20.82-.31,28.51-8s7.85-18.75,8-28.51c.08-5.25.16-10.67,1.52-13.94,1.47-3.56,5.37-7.63,9.14-11.57C232.49,146.28,240,138.44,240,128S232.49,109.73,225.86,102.82Zm-11.55,39.29c-4.79,5-9.75,10.17-12.38,16.52-2.52,6.1-2.63,13.07-2.73,19.82-.1,7-.21,14.33-3.32,17.43s-10.39,3.22-17.43,3.32c-6.75.1-13.72.21-19.82,2.73-6.35,2.63-11.52,7.59-16.52,12.38S132,224,128,224s-9.15-4.92-14.11-9.69-10.17-9.75-16.52-12.38c-6.1-2.52-13.07-2.63-19.82-2.73-7-.1-14.33-.21-17.43-3.32s-3.22-10.39-3.32-17.43c-.1-6.75-.21-13.72-2.73-19.82-2.63-6.35-7.59-11.52-12.38-16.52S32,132,32,128s4.92-9.15,9.69-14.11,9.75-10.17,12.38-16.52c2.52-6.1,2.63-13.07,2.73-19.82.1-7,.21-14.33,3.32-17.43S70.51,56.9,77.55,56.8c6.75-.1,13.72-.21,19.82-2.73,6.35-2.63,11.52-7.59,16.52-12.38S124,32,128,32s9.15,4.92,14.11,9.69,10.17,9.75,16.52,12.38c6.1,2.52,13.07,2.63,19.82,2.73,7,.1,14.33.21,17.43,3.32s3.22,10.39,3.32,17.43c.1,6.75.21,13.72,2.73,19.82,2.63,6.35,7.59,11.52,12.38,16.52S224,124,224,128,219.08,137.15,214.31,142.11ZM173.66,98.34a8,8,0,0,1,0,11.32l-56,56a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35A8,8,0,0,1,173.66,98.34Z">
                            </path>
                        </svg> Waterproof</div>
                    <div class="badge"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            fill="#32a852" viewBox="0 0 256 256">
                            <path
                                d="M225.86,102.82c-3.77-3.94-7.67-8-9.14-11.57-1.36-3.27-1.44-8.69-1.52-13.94-.15-9.76-.31-20.82-8-28.51s-18.75-7.85-28.51-8c-5.25-.08-10.67-.16-13.94-1.52-3.56-1.47-7.63-5.37-11.57-9.14C146.28,23.51,138.44,16,128,16s-18.27,7.51-25.18,14.14c-3.94,3.77-8,7.67-11.57,9.14C88,40.64,82.56,40.72,77.31,40.8c-9.76.15-20.82.31-28.51,8S41,67.55,40.8,77.31c-.08,5.25-.16,10.67-1.52,13.94-1.47,3.56-5.37,7.63-9.14,11.57C23.51,109.72,16,117.56,16,128s7.51,18.27,14.14,25.18c3.77,3.94,7.67,8,9.14,11.57,1.36,3.27,1.44,8.69,1.52,13.94.15,9.76.31,20.82,8,28.51s18.75,7.85,28.51,8c5.25.08,10.67.16,13.94,1.52,3.56,1.47,7.63,5.37,11.57,9.14C109.72,232.49,117.56,240,128,240s18.27-7.51,25.18-14.14c3.94-3.77,8-7.67,11.57-9.14,3.27-1.36,8.69-1.44,13.94-1.52,9.76-.15,20.82-.31,28.51-8s7.85-18.75,8-28.51c.08-5.25.16-10.67,1.52-13.94,1.47-3.56,5.37-7.63,9.14-11.57C232.49,146.28,240,138.44,240,128S232.49,109.73,225.86,102.82Zm-11.55,39.29c-4.79,5-9.75,10.17-12.38,16.52-2.52,6.1-2.63,13.07-2.73,19.82-.1,7-.21,14.33-3.32,17.43s-10.39,3.22-17.43,3.32c-6.75.1-13.72.21-19.82,2.73-6.35,2.63-11.52,7.59-16.52,12.38S132,224,128,224s-9.15-4.92-14.11-9.69-10.17-9.75-16.52-12.38c-6.1-2.52-13.07-2.63-19.82-2.73-7-.1-14.33-.21-17.43-3.32s-3.22-10.39-3.32-17.43c-.1-6.75-.21-13.72-2.73-19.82-2.63-6.35-7.59-11.52-12.38-16.52S32,132,32,128s4.92-9.15,9.69-14.11,9.75-10.17,12.38-16.52c2.52-6.1,2.63-13.07,2.73-19.82.1-7,.21-14.33,3.32-17.43S70.51,56.9,77.55,56.8c6.75-.1,13.72-.21,19.82-2.73,6.35-2.63,11.52-7.59,16.52-12.38S124,32,128,32s9.15,4.92,14.11,9.69,10.17,9.75,16.52,12.38c6.1,2.52,13.07,2.63,19.82,2.73,7,.1,14.33.21,17.43,3.32s3.22,10.39,3.32,17.43c.1,6.75.21,13.72,2.73,19.82,2.63,6.35,7.59,11.52,12.38,16.52S224,124,224,128,219.08,137.15,214.31,142.11ZM173.66,98.34a8,8,0,0,1,0,11.32l-56,56a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35A8,8,0,0,1,173.66,98.34Z">
                            </path>
                        </svg> Termite Proof</div>
                    <div class="badge"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            fill="#32a852" viewBox="0 0 256 256">
                            <path
                                d="M225.86,102.82c-3.77-3.94-7.67-8-9.14-11.57-1.36-3.27-1.44-8.69-1.52-13.94-.15-9.76-.31-20.82-8-28.51s-18.75-7.85-28.51-8c-5.25-.08-10.67-.16-13.94-1.52-3.56-1.47-7.63-5.37-11.57-9.14C146.28,23.51,138.44,16,128,16s-18.27,7.51-25.18,14.14c-3.94,3.77-8,7.67-11.57,9.14C88,40.64,82.56,40.72,77.31,40.8c-9.76.15-20.82.31-28.51,8S41,67.55,40.8,77.31c-.08,5.25-.16,10.67-1.52,13.94-1.47,3.56-5.37,7.63-9.14,11.57C23.51,109.72,16,117.56,16,128s7.51,18.27,14.14,25.18c3.77,3.94,7.67,8,9.14,11.57,1.36,3.27,1.44,8.69,1.52,13.94.15,9.76.31,20.82,8,28.51s18.75,7.85,28.51,8c5.25.08,10.67.16,13.94,1.52,3.56,1.47,7.63,5.37,11.57,9.14C109.72,232.49,117.56,240,128,240s18.27-7.51,25.18-14.14c3.94-3.77,8-7.67,11.57-9.14,3.27-1.36,8.69-1.44,13.94-1.52,9.76-.15,20.82-.31,28.51-8s7.85-18.75,8-28.51c.08-5.25.16-10.67,1.52-13.94,1.47-3.56,5.37-7.63,9.14-11.57C232.49,146.28,240,138.44,240,128S232.49,109.73,225.86,102.82Zm-11.55,39.29c-4.79,5-9.75,10.17-12.38,16.52-2.52,6.1-2.63,13.07-2.73,19.82-.1,7-.21,14.33-3.32,17.43s-10.39,3.22-17.43,3.32c-6.75.1-13.72.21-19.82,2.73-6.35,2.63-11.52,7.59-16.52,12.38S132,224,128,224s-9.15-4.92-14.11-9.69-10.17-9.75-16.52-12.38c-6.1-2.52-13.07-2.63-19.82-2.73-7-.1-14.33-.21-17.43-3.32s-3.22-10.39-3.32-17.43c-.1-6.75-.21-13.72-2.73-19.82-2.63-6.35-7.59-11.52-12.38-16.52S32,132,32,128s4.92-9.15,9.69-14.11,9.75-10.17,12.38-16.52c2.52-6.1,2.63-13.07,2.73-19.82.1-7,.21-14.33,3.32-17.43S70.51,56.9,77.55,56.8c6.75-.1,13.72-.21,19.82-2.73,6.35-2.63,11.52-7.59,16.52-12.38S124,32,128,32s9.15,4.92,14.11,9.69,10.17,9.75,16.52,12.38c6.1,2.52,13.07,2.63,19.82,2.73,7,.1,14.33.21,17.43,3.32s3.22,10.39,3.32,17.43c.1,6.75.21,13.72,2.73,19.82,2.63,6.35,7.59,11.52,12.38,16.52S224,124,224,128,219.08,137.15,214.31,142.11ZM173.66,98.34a8,8,0,0,1,0,11.32l-56,56a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35A8,8,0,0,1,173.66,98.34Z">
                            </path>
                        </svg> Fire Retardant</div>
                </div>
                <a href="#plywoods" class="hero-btn">Explore Products</a>
            </div>
            <div class="hero-form">
                <div class="form-card">
                    <h3>Get a Free Quote</h3>
                    <p>Our experts will reach out to you</p>
                    <input type="text" placeholder="Your Name" class="form-input" />
                    <input type="tel" placeholder="Phone Number" class="form-input" />
                    <input type="email" placeholder="Email Address" class="form-input" />
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
            <div class="strip-item"><span class="strip-icon"><img class="strip-icon-img"
                        src="{{ asset('assets/icons/waterproof.png') }}" alt="Waterproof"> </span><span>Boiling
                    Waterproof</span>
            </div>
            <div class="strip-item"><span class="strip-icon">🔥</span><span>Fire Retardant</span></div>
            <div class="strip-item"><span class="strip-icon">🪲</span><span>Termite Proof</span></div>
            <div class="strip-item"><span class="strip-icon">🏆</span><span>30-Year Warranty</span></div>
            <div class="strip-item"><span class="strip-icon">🌱</span><span>Eco Compliant</span></div>
            <div class="strip-item"><span class="strip-icon"><svg xmlns="http://www.w3.org/2000/svg" width="26"
                        height="26" fill="#26e059" viewBox="0 0 256 256">
                        <path
                            d="M225.86,102.82c-3.77-3.94-7.67-8-9.14-11.57-1.36-3.27-1.44-8.69-1.52-13.94-.15-9.76-.31-20.82-8-28.51s-18.75-7.85-28.51-8c-5.25-.08-10.67-.16-13.94-1.52-3.56-1.47-7.63-5.37-11.57-9.14C146.28,23.51,138.44,16,128,16s-18.27,7.51-25.18,14.14c-3.94,3.77-8,7.67-11.57,9.14C88,40.64,82.56,40.72,77.31,40.8c-9.76.15-20.82.31-28.51,8S41,67.55,40.8,77.31c-.08,5.25-.16,10.67-1.52,13.94-1.47,3.56-5.37,7.63-9.14,11.57C23.51,109.72,16,117.56,16,128s7.51,18.27,14.14,25.18c3.77,3.94,7.67,8,9.14,11.57,1.36,3.27,1.44,8.69,1.52,13.94.15,9.76.31,20.82,8,28.51s18.75,7.85,28.51,8c5.25.08,10.67.16,13.94,1.52,3.56,1.47,7.63,5.37,11.57,9.14C109.72,232.49,117.56,240,128,240s18.27-7.51,25.18-14.14c3.94-3.77,8-7.67,11.57-9.14,3.27-1.36,8.69-1.44,13.94-1.52,9.76-.15,20.82-.31,28.51-8s7.85-18.75,8-28.51c.08-5.25.16-10.67,1.52-13.94,1.47-3.56,5.37-7.63,9.14-11.57C232.49,146.28,240,138.44,240,128S232.49,109.73,225.86,102.82Zm-11.55,39.29c-4.79,5-9.75,10.17-12.38,16.52-2.52,6.1-2.63,13.07-2.73,19.82-.1,7-.21,14.33-3.32,17.43s-10.39,3.22-17.43,3.32c-6.75.1-13.72.21-19.82,2.73-6.35,2.63-11.52,7.59-16.52,12.38S132,224,128,224s-9.15-4.92-14.11-9.69-10.17-9.75-16.52-12.38c-6.1-2.52-13.07-2.63-19.82-2.73-7-.1-14.33-.21-17.43-3.32s-3.22-10.39-3.32-17.43c-.1-6.75-.21-13.72-2.73-19.82-2.63-6.35-7.59-11.52-12.38-16.52S32,132,32,128s4.92-9.15,9.69-14.11,9.75-10.17,12.38-16.52c2.52-6.1,2.63-13.07,2.73-19.82.1-7,.21-14.33,3.32-17.43S70.51,56.9,77.55,56.8c6.75-.1,13.72-.21,19.82-2.73,6.35-2.63,11.52-7.59,16.52-12.38S124,32,128,32s9.15,4.92,14.11,9.69,10.17,9.75,16.52,12.38c6.1,2.52,13.07,2.63,19.82,2.73,7,.1,14.33.21,17.43,3.32s3.22,10.39,3.32,17.43c.1,6.75.21,13.72,2.73,19.82,2.63,6.35,7.59,11.52,12.38,16.52S224,124,224,128,219.08,137.15,214.31,142.11ZM173.66,98.34a8,8,0,0,1,0,11.32l-56,56a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35A8,8,0,0,1,173.66,98.34Z">
                        </path>
                    </svg></span><span>BIS Certified</span></div>
        </div>
    </section>

    <section class="about-us" id="about">
        <div class="about-container">

            <!-- Left: Image Block -->
            <div class="about-img-block reveal">
                <div class="about-img-main-wrap">
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=700&q=85"
                        alt="WoodCraft Factory" class="about-img-main" />
                    <div class="about-img-badge">
                        <span class="badge-number">30+</span>
                        <span class="badge-text">Years of<br>Excellence</span>
                    </div>
                </div>
                <div class="about-img-secondary-wrap">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&q=85"
                        alt="WoodCraft Workshop" class="about-img-secondary" />
                </div>
                <!-- Decorative dots -->
                <div class="about-dots">
                    <svg width="120" height="120" viewBox="0 0 120 120">
                        <defs>
                            <pattern id="dot-pattern" x="0" y="0" width="12" height="12"
                                patternUnits="userSpaceOnUse">
                                <circle cx="2" cy="2" r="2" fill="var(--red)" opacity="0.25" />
                            </pattern>
                        </defs>
                        <rect width="120" height="120" fill="url(#dot-pattern)" />
                    </svg>
                </div>
            </div>

            <!-- Right: Content -->
            <div class="about-content">
                <p class="about-eyebrow reveal-line">Our Story</p>

                <h2 class="about-title reveal">
                    Crafting Trust Since<br />
                    <span class="about-accent">1992</span>
                </h2>

                <!-- Animated line -->
                <div class="about-line-anim reveal">
                    <span class="line-segment seg1"></span>
                    <span class="line-segment seg2"></span>
                    <span class="line-dot"></span>
                </div>

                <p class="about-desc reveal">
                    WoodCraft Premium was founded with a simple vision — to bring superior-quality plywood and wood
                    products to homes and businesses across the country. Over the years, we have earned the trust of
                    thousands of customers by consistently delivering strength, durability, and craftsmanship in every
                    product we create.
                </p>

                <p class="about-desc reveal">
                    Every sheet of plywood, board, and door that leaves our facility undergoes over 100 rigorous quality
                    checks to ensure exceptional performance and reliability. Our commitment to innovation, quality, and
                    customer satisfaction has made WoodCraft Premium a trusted choice for architects, interior
                    designers, builders, and homeowners alike
                </p>

                <!-- Stats row -->
                <div class="about-stats reveal">
                    <div class="about-stat">
                        <span class="stat-num" data-target="50000">0</span><span class="stat-suffix">+</span>
                        <span class="stat-label">Happy Families</span>
                    </div>
                    <div class="about-stat-divider"></div>
                    <div class="about-stat">
                        <span class="stat-num" data-target="500">0</span><span class="stat-suffix">+</span>
                        <span class="stat-label">Cities Served</span>
                    </div>
                    <div class="about-stat-divider"></div>
                    <div class="about-stat">
                        <span class="stat-num" data-target="100">0</span><span class="stat-suffix">+</span>
                        <span class="stat-label">Quality Tests</span>
                    </div>
                </div>

                <!-- Feature pills -->
                <div class="about-pills reveal">
                    <span class="about-pill">🏅 BIS Certified</span>
                    <span class="about-pill">🌱 Eco Compliant</span>
                    <span class="about-pill">🔥 Fire Retardant</span>
                    <span class="about-pill">💧 Waterproof</span>
                </div>

                <a href="#contact" class="about-cta reveal">Get in Touch →</a>
            </div>

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
                    {{-- <div class="card-badge">Best Seller</div> --}}
                    <div class="card-img-wrap">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=280&fit=crop"
                            alt="Marine Plywood" class="card-img" />
                        <div class="card-overlay">
                            <button class="quick-enq" onclick="openModal('Marine Plywood BWP 710')">Quick
                                Enquiry</button>
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
                    {{-- <div class="card-badge new">New Arrival</div> --}}
                    <div class="card-img-wrap">
                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=400&h=280&fit=crop"
                            alt="Fire Retardant Ply" class="card-img" />
                        <div class="card-overlay">
                            <button class="quick-enq" onclick="openModal('Fire Retardant Plywood')">Quick
                                Enquiry</button>
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
                        <img src="https://images.unsplash.com/photo-1567016432779-094069958ea5?w=400&h=280&fit=crop"
                            alt="Commercial Plywood" class="card-img" />
                        <div class="card-overlay">
                            <button class="quick-enq" onclick="openModal('Commercial Plywood MR Grade')">Quick
                                Enquiry</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-name">Commercial Plywood MR Grade</h3>
                        <p class="card-desc">Moisture Resistant · 18mm · Eucalyptus Core</p>
                        <div class="card-pricing">
                            <span class="market-price">₹3,100/sheet</span>
                            <span class="our-price">₹2,499/sheet</span>
                        </div>
                        <button class="enq-btn" onclick="openModal('Commercial Plywood MR Grade')">Enquiry
                            Now</button>
                    </div>
                </div>

                <div class="product-card reveal">
                    {{-- <div class="card-badge hot">Hot Deal</div> --}}
                    <div class="card-img-wrap">
                        <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=400&h=280&fit=crop"
                            alt="Calibrated Plywood" class="card-img" />
                        <div class="card-overlay">
                            <button class="quick-enq" onclick="openModal('Calibrated Plywood Premium')">Quick
                                Enquiry</button>
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
                    {{-- <div class="card-badge">Premium</div> --}}
                    <div class="card-img-wrap">
                        <img src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=400&h=280&fit=crop"
                            alt="Teak Blockboard" class="card-img" />
                        <div class="card-overlay">
                            <button class="quick-enq" onclick="openModal('Teak Blockboard 25mm')">Quick
                                Enquiry</button>
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
                        <img src="https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?w=400&h=280&fit=crop"
                            alt="Pine Blockboard" class="card-img" />
                        <div class="card-overlay">
                            <button class="quick-enq" onclick="openModal('Pine Core Blockboard')">Quick
                                Enquiry</button>
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
                    {{-- <div class="card-badge new">New</div> --}}
                    <div class="card-img-wrap">
                        <img src="https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=400&h=280&fit=crop"
                            alt="MDF Blockboard" class="card-img" />
                        <div class="card-overlay">
                            <button class="quick-enq" onclick="openModal('MDF Core Blockboard')">Quick
                                Enquiry</button>
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
                    {{-- <div class="card-badge hot">Hot Deal</div> --}}
                    <div class="card-img-wrap">
                        <img src="https://images.unsplash.com/photo-1484101403633-562f891dc89a?w=400&h=280&fit=crop"
                            alt="Eucalyptus Blockboard" class="card-img" />
                        <div class="card-overlay">
                            <button class="quick-enq" onclick="openModal('Eucalyptus Blockboard BWR')">Quick
                                Enquiry</button>
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
                    {{-- <div class="card-badge">Top Pick</div> --}}
                    <div class="card-img-wrap">
                        <img src="https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=400&h=280&fit=crop"
                            alt="Flush Door" class="card-img" />
                        <div class="card-overlay">
                            <button class="quick-enq" onclick="openModal('Flush Door – Solid Core')">Quick
                                Enquiry</button>
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
                    {{-- <div class="card-badge new">Trending</div> --}}
                    <div class="card-img-wrap">
                        <img src="https://images.unsplash.com/photo-1600566752355-35792bedcfea?w=400&h=280&fit=crop"
                            alt="Designer Panel Door" class="card-img" />
                        <div class="card-overlay">
                            <button class="quick-enq" onclick="openModal('Designer Panel Door – Walnut')">Quick
                                Enquiry</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-name">Designer Panel Door – Walnut</h3>
                        <p class="card-desc">Walnut Veneer · 40mm · Panel Design</p>
                        <div class="card-pricing">
                            <span class="market-price">₹12,000/door</span>
                            <span class="our-price">₹9,499/door</span>
                        </div>
                        <button class="enq-btn" onclick="openModal('Designer Panel Door – Walnut')">Enquiry
                            Now</button>
                    </div>
                </div>

                <div class="product-card reveal">
                    <div class="card-img-wrap">
                        <img src="https://images.unsplash.com/photo-1502005229762-cf1b2da7c5d6?w=400&h=280&fit=crop"
                            alt="WPC Door" class="card-img" />
                        <div class="card-overlay">
                            <button class="quick-enq" onclick="openModal('WPC Door – Waterproof')">Quick
                                Enquiry</button>
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
                    {{-- <div class="card-badge hot">Best Value</div> --}}
                    <div class="card-img-wrap">
                        <img src="https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=400&h=280&fit=crop"
                            alt="Membrane Door" class="card-img" />
                        <div class="card-overlay">
                            <button class="quick-enq" onclick="openModal('Membrane Door – High Gloss')">Quick
                                Enquiry</button>
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
    <!-- ========== ABOUT US ========== -->


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
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h4>Contact Us</h4>
                @if ($settings->phone)
                    <p>📞 {{ $settings->phone }}</p>
                @endif
                @if ($settings->email)
                    <p>📧 {{ $settings->email }}</p>
                @endif
                @if ($settings->address)
                    <p>📍 {{ $settings->address }}</p>
                @endif
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
                <input type="text" id="enqName" placeholder="Enter your full name" />
            </div>
            <div class="modal-field">
                <label>Phone Number *</label>
                <input type="tel" id="enqPhone" placeholder="+91 00000 00000" />
            </div>
            <div class="modal-field">
                <label>Email Address</label>
                <input type="email" id="enqEmail" placeholder="your@email.com" />
            </div>
            <div class="modal-field">
                <label>City</label>
                <input type="text" id="enqCity" placeholder="Your city" />
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
