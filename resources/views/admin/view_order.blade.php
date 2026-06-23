<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&amp;family=Playfair+Display:wght@700&amp;family=Inter:wght@400;500;600&amp;display=swap"
    rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&amp;display=swap"
    rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
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
<style>
    body {
        font-family: 'Inter', sans-serif;
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }

    .table-card:hover {
        transform: translateY(-4px);
    }
</style>

<div class="wrapper container-xxl flex-grow-1 container-p-y">

    <header
        class="flex items-center justify-between px-8 py-4 bg-white dark:bg-background-dark border-b border-primary/10 shadow-sm sticky top-0 z-50 table-header">
        <div class="flex items-center gap-10">
            <div class="flex items-center gap-3 heading-title">
                <div class="size-10 rounded-xl flex items-center justify-center text-accent icon-box">
                    <span class="material-symbols-outlined text-2xl">restaurant</span>
                </div>
                <h2>Royal Dine</h2>
            </div>
            <nav class="hidden md:flex items-center gap-8 nav-menu">
                <a class="menu-items active" href="#">Tables</a>
                <a class="menu-items" href="#">Menu</a>
                <a class="menu-items" href="#">Orders</a>
                <a class="menu-items" href="#">Staff</a>
            </nav>
        </div>
        <div class="flex items-center gap-6">
            <div class="relative w-64 search-bar">
                <span
                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                <input class="w-full pl-10 pr-4 py-2 rounded-xl transition-all text-sm"
                    placeholder="Search tables or items..." type="text" />
            </div>
            <div class="flex items-center gap-3 border-l border-slate-200 dark:border-slate-700 pl-6 user-box">
                <!-- <button class="p-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 relative">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute top-2 right-2 size-2 bg-primary rounded-full border-2 border-white"></span>
                </button> -->
                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <p class="text-xs font-bold leading-none user-name">Julian Moore</p>
                        <p class="text-[10px] text-slate-400 uppercase tracking-widest mt-1 user-post">Head Server</p>
                    </div>
                    <div
                        class="size-10 rounded-xl bg-primary/10 flex items-center justify-center overflow-hidden border border-accent/20">
                        <img class="w-full h-full object-cover" data-alt="User profile photo of Julian Moore"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBBk5KExeLgc252wGi5jd5hGj95dJejrZRWDYaKZsWDGBfFwakvxE6ZXoYXA4T6iCdE4e2uFT_wWpLU5EOzp_lUhCYypTP-UQoFwYDy93_iyoNiOz2TFeKTl8FfPbxdbdryaOEm_DeYH1Hc25eMJRrwpKlpgdh7K-03L5L2k1lYHECFLXPJyUPzIjFqSbLX299uMrgfuaoyJ3s8DacyCIRq1rX-I477MQRtEk14ecduBzGG4YPXucJCMvLxMQWsgfbmz_G2s3vsjYU" />
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="main-part">
        <!-- LEFT PANEL: Table Selection (30%) -->
        <aside class="border-r border-slate-200 dark:border-slate-800 flex flex-col bg-slate-50 dark:bg-zinc-900/50 aside-section">
            <div class="p-6 table_floor_plan">
                <h3 class="text-xl text-black dark:text-accent mb-4 ">Table Floor Plan</h3>
                <div class="flex gap-2 overflow-x-auto pb-2 flex-wrap">
                    <button
                        class="whitespace-nowrap px-4 py-1.5 rounded-full bg-primary text-white text-xs font-medium">All
                        Tables</button>
                    <button
                        class="whitespace-nowrap px-4 py-1.5 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-xs text-slate-500">Main
                        Hall</button>
                    <button
                        class="whitespace-nowrap px-4 py-1.5 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-xs text-slate-500">Terrace</button>
                    <button
                        class="whitespace-nowrap px-4 py-1.5 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-xs text-slate-500">Private
                        VIP</button>
                </div>
            </div>
            <div
                class="flex-1 overflow-y-auto px-6 pb-6 custom-scrollbar grid grid-cols-1 xl:grid-cols-2 gap-4 auto-rows-max">
                <!-- Table Card 1: Occupied -->
                <div
                    class="active glass-card p-5 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-all cursor-pointer flex flex-col justify-between min-h-[160px]">
                    <div class="flex justify-between items-start top-one">
                        <div>
                            <p class="text-xs uppercase tracking-widest text-primary font-bold">Table 04</p>
                            <h4 class="text-sm md:text-lg mt-1">VIP Booth</h4>
                        </div>
                        <span class="material-symbols-outlined text-primary">person</span>
                    </div>
                    <div class="mt-4 flex justify-between items-end bottom-one">
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">4 Guests</p>
                            <p class="text-xs font-semibold text-primary mt-1 flex items-center gap-1">
                                <span class="size-1.5 rounded-full bg-primary"></span> Occupied
                            </p>
                        </div>
                        <div
                            class="flex items-center gap-1 text-[10px] font-mono bg-primary/10 px-2 py-1 rounded text-primary">
                            <span class="material-symbols-outlined text-xs">timer</span> 12:45
                        </div>
                    </div>
                </div>
                <!-- Table Card 2: Available -->
                <div
                    class="glass-card p-5 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-all cursor-pointer flex flex-col justify-between min-h-[160px]">
                    <div class="flex justify-between items-start top-one">
                        <div>
                            <p class="text-xs uppercase tracking-widest text-slate-400 font-bold">Table 01</p>
                            <h4 class="text-sm md:text-lg mt-1">Window Seat</h4>
                        </div>
                        <span class="material-symbols-outlined text-emerald-500">check_circle</span>
                    </div>
                    <button
                        class="mt-4 w-full bg-primary text-white py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-primary/90 transition-colors">
                        Order Now
                    </button>
                </div>
                <!-- Table Card 3: Preparing -->
                <div
                    class="glass-card p-5 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-all cursor-pointer flex flex-col justify-between min-h-[160px]">
                    <div class="flex justify-between items-start top-one">
                        <div>
                            <p class="text-xs uppercase tracking-widest text-slate-400 font-bold">Table 08</p>
                            <h4 class="text-sm md:text-lg mt-1">Round Table</h4>
                        </div>
                        <span class="material-symbols-outlined text-amber-500">autorenew</span>
                    </div>
                    <button
                        class="mt-4 w-full bg-primary text-white py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-primary/90 transition-colors">
                        Order Now
                    </button>
                </div>
                <!-- Table Card 4: Payment Pending -->
                <div
                    class="glass-card p-5 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-all cursor-pointer flex flex-col justify-between min-h-[160px]">
                    <div class="flex justify-between items-start top-one">
                        <div>
                            <p class="text-xs uppercase tracking-widest text-slate-400 font-bold">Table 02</p>
                            <h4 class="text-sm md:text-lg mt-1">Center Deck</h4>
                        </div>
                        <span class="material-symbols-outlined text-blue-500">payments</span>
                    </div>
                    <button
                        class="mt-4 w-full bg-primary text-white py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-primary/90 transition-colors">
                        Order Now
                    </button>
                </div>
                <!-- Table Card 5: Available -->
                <div
                    class="glass-card p-5 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-all cursor-pointer flex flex-col justify-between min-h-[160px]">
                    <div class="flex justify-between items-start top-one">
                        <div>
                            <p class="text-xs uppercase tracking-widest text-slate-400 font-bold">Table 05</p>
                            <h4 class="text-sm md:text-lg mt-1">Lounge B</h4>
                        </div>
                        <span class="material-symbols-outlined text-emerald-500">check_circle</span>
                    </div>
                    <button
                        class="mt-4 w-full bg-primary text-white py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-primary/90 transition-colors">
                        Order Now
                    </button>
                </div>
                <!-- Table Card 6: Available -->
                <div
                    class="glass-card p-5 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-all cursor-pointer flex flex-col justify-between min-h-[160px] ">
                    <div class="flex justify-between items-start top-one">
                        <div>
                            <p class="text-xs uppercase tracking-widest text-slate-400 font-bold">Table 06</p>
                            <h4 class="text-sm md:text-lg mt-1">Terrace 1</h4>
                        </div>
                        <span class="material-symbols-outlined text-emerald-500">check_circle</span>
                    </div>
                    <button
                        class="mt-4 w-full bg-primary text-white py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-primary/90 transition-colors">
                        Order Now
                    </button>
                </div>
            </div>
        </aside>
        <!-- RIGHT PANEL: Order Details (70%) -->
        <section class="flex flex-col view-take-order">
            <!-- TOP: Selected Table Info -->
            <div
                class="pt-8 py-8 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center bg-background-light/50 dark:bg-zinc-900/30 flex flex-wrap gap-y-[30px] table-booth">
                <div class="flex items-center gap-8 table-number">
                    <div>
                        <h2 class="heading-title">Table 04 <span class="text-slate-300 font-light mx-2">/</span> VIP
                            Booth</h2>
                        <div class="flex gap-4 mt-2">
                            <span class="flex items-center gap-1.5 text-xs font-medium text-slate-500"><span
                                    class="material-symbols-outlined text-sm">groups</span> 4 Guests</span>
                            <span class="flex items-center gap-1.5 text-xs font-medium text-slate-500"><span
                                    class="material-symbols-outlined text-sm">person</span> Julian Moore</span>
                        </div>
                    </div>
                    <div class="h-12 w-px bg-slate-200 dark:bg-slate-800"></div>
                    <div class="timer-section">
                        <p class="session-timer">Session Timer</p>
                        <p class="timer">12:45:08</p>
                    </div>
                </div>
                <div class="flex gap-3 button-style">
                    <button class="custom-button flex items-center gap-2 transition-all">
                        <span class="material-symbols-outlined text-sm">move_item</span> Change Table
                    </button>
                    <button class="custom-button button-two flex items-center gap-2 transition-all">
                        <span class="material-symbols-outlined text-sm">print</span> Print KOT
                    </button>
                </div>
            </div>
            <!-- MIDDLE: Order Items List -->
            <div class="flex-1 table-css-wrapper">
                <div class="table-responsive-layout">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-slate-400 text-[10px] uppercase tracking-[0.2em] font-bold">
                                <th class="item-details">Item Details</th>
                                <th class="price">Price</th>
                                <th class="quantity">Quantity</th>
                                <th class="service">Service</th>
                                <th class="total">Total</th>
                            </tr>
                        </thead>
                        <tbody class="space-y-4">
                            <!-- Order Row 1 -->
                            <tr class="glass-card transition-shadow">
                                <td class="py-4 pl-4 rounded-l-xl">
                                    <div class="flex items-center gap-4">
                                        <div class="size-14 rounded-lg bg-cover bg-center"
                                            data-alt="Close up of Truffle Risotto dish"
                                            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCeaqjCMOKQyjBRC5jW-n5VQy6aW1z-UjPyt5_DwnuukLlzfqiyLxnr59tqZNh5BTOXw4atNq0EBwSvUwIBe4NjWIAHhiloZW2WQg85w5PTce5qlTvB-tOJxk9EhuckGizH_4T4VhjU9fJn4in_8i4voxQFejhldbS2dw1bOsQMnRICvVFj3ZwboEaGlveI3oHdiZT8DqypUrRTfoFOxnTJPQK7vAUC3k0mgGFCibKgPvaPYDK0EZiXzMcd1IlW2L2yKUd6BEB2INk')">
                                        </div>
                                        <div>
                                            <p class="item-title">Truffle Risotto</p>
                                            <p class="small-text">Extra Parmesan shavings</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="price-text">$28.00</td>
                                <td class="py-4">
                                    <div class="flex items-center qty gap-3">
                                        <button
                                            class="size-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50">-</button>
                                        <span class="font-bold text-lg w-4 text-center">1</span>
                                        <button
                                            class="size-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50">+</button>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="flex p-1 bg-slate-100 dark:bg-slate-800 rounded-lg w-fit toggle-box">
                                        <button
                                            class="active px-3 py-1 text-[10px] font-bold rounded-md bg-white dark:bg-slate-700 shadow-sm text-primary">DINE
                                            IN</button>
                                        <button
                                            class="px-3 py-1 text-[10px] font-bold rounded-md text-slate-400">PARCEL</button>
                                    </div>
                                </td>
                                <td class="py-4 pr-4 rounded-r-xl font-bold total-count">$28.00</td>
                            </tr>
                            <!-- Order Row 2 -->
                            <tr class="glass-card transition-shadow">
                                <td class="py-4 pl-4 rounded-l-xl">
                                    <div class="flex items-center gap-4">
                                        <div class="size-14 rounded-lg bg-cover bg-center"
                                            data-alt="Elegant wine bottle and glass"
                                            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBWkjsfQytDT442WyKiWR0fgYYSjqBpqTunOtQtTLwC2bxmJEQeIZB0UQ--99k2SAC22kP-NygnORK6WW8PJ_VJF2_cIyeNmjbF-_dHP5_X_18OKP77s7A9SPGkhs58voyC2ddf7E09O_ymAT6SFHNTYCjko5LhtLMiDzftiDD4fJd2-k1lOAqPU0J-9cYd7g3Xyi3GLzcnh59P5fNZdtWSX5CmOxM76FdRuKzXmw8hJ7E5ov_UY6raORj7juU3kvbTfgADZFKAocc')">
                                        </div>
                                        <div>
                                            <p class="item-title">Vintage Bordeaux</p>
                                            <p class="small-text">2015 Reserve</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="price-text">$115.00</td>
                                <td class="py-4">
                                    <div class="flex items-center qty gap-3">
                                        <button
                                            class="size-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50">-</button>
                                        <span class="font-bold text-lg w-4 text-center">2</span>
                                        <button
                                            class="size-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50">+</button>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="flex p-1 bg-slate-100 dark:bg-slate-800 rounded-lg w-fit toggle-box">
                                        <button
                                            class="px-3 py-1 text-[10px] font-bold rounded-md bg-white dark:bg-slate-700 shadow-sm text-primary">DINE
                                            IN</button>
                                        <button
                                            class="active px-3 py-1 text-[10px] font-bold rounded-md text-slate-400">PARCEL</button>
                                    </div>
                                </td>
                                <td class="py-4 pr-4 rounded-r-xl font-bold total-count">$230.00</td>
                            </tr>
                            <!-- Order Row 3 -->
                            <tr class="glass-card transition-shadow">
                                <td class="py-4 pl-4 rounded-l-xl">
                                    <div class="flex items-center gap-4">
                                        <div class="size-14 rounded-lg bg-cover bg-center"
                                            data-alt="Plate of gold leaf macarons"
                                            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD4EcRGO8JbDH9xIka1_fwBx-HMNL-xkDLxwOjSx8kC5liiBjtwa7YkBTmTNWbF37C_DnV7gItqCeCDZb6UT_QvLad4jAtzQ0Q82kzACHsj9z6m7a6gNVU1fpwrsYPCuy7NXUcPzW7GZzu0OqhEHyOaUfw8BNza2F32ZsuucVGnlQyxWJIuW6axbr2_iG9CJlZkActjlcO-22MfRsHDzUlElc7zZs6ys_9Xxz8NupGnz6p0cGkP5b9Bip72t3YeSDCKu23GELFEe_A')">
                                        </div>
                                        <div>
                                            <p class="item-title">Gold Leaf Macarons</p>
                                            <p class="small-text">Box of 6 assorted</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="price-text">$18.00</td>
                                <td class="py-4">
                                    <div class="flex items-center qty gap-3">
                                        <button
                                            class="size-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50">-</button>
                                        <span class="font-bold text-lg w-4 text-center">1</span>
                                        <button
                                            class="size-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50">+</button>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="flex p-1 bg-slate-100 dark:bg-slate-800 rounded-lg w-fit toggle-box">
                                        <button
                                            class="active px-3 py-1 text-[10px] font-bold rounded-md text-slate-400">DINE
                                            IN</button>
                                        <button
                                            class="px-3 py-1 text-[10px] font-bold rounded-md bg-white dark:bg-slate-700 shadow-sm text-primary">PARCEL</button>
                                    </div>
                                </td>
                                <td class="py-4 pr-4 rounded-r-xl font-bold total-count">$18.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- BOTTOM: Order Actions & Summary -->
            <div class="pt-8 bg-slate-50 dark:bg-zinc-900 border-slate-200 dark:border-slate-800">
                <div class="w-full max-w-[600px] ml-auto block">
                    <!-- Notes Section -->
                    <!-- <div class="flex flex-col gap-3">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Order Notes &amp;
                            Special Requests</label>
                        <textarea
                            class="w-full h-32 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-4 text-sm focus:ring-primary/20 transition-all resize-none"
                            placeholder="e.g. Allergy information, birthday surprise, steak medium-rare..."></textarea>
                    </div> -->
                    <!-- Summary & Action -->
                    <div class="flex flex-col card-totals">
                        <div class="glass-card rounded-xl flex flex-col gap-3 card_totals_table_wrap_div">
                            <div class="flex justify-between items-center text-sm card_totals_table_wrap">
                                <span class="text-slate-500">Total Items</span>
                                <span class="font-bold">4 Items</span>
                            </div>
                            <div class="flex justify-between items-center text-sm card_totals_table_wrap">
                                <span class="text-slate-500">Subtotal</span>
                                <span class="font-bold">$276.00</span>
                            </div>
                            <div class="flex justify-between items-center text-sm card_totals_table_wrap">
                                <span class="text-slate-500">Service Charge (10%)</span>
                                <span class="font-bold">$27.60</span>
                            </div>
                            <div class="flex justify-between items-center card_totals_table_wrap total_payable">
                                <span class="text-xl dark:text-accent">Total Payable</span>
                                <span class="text-2xl dark:text-accent">$303.60</span>
                            </div>
                        </div>
                        <button
                            class="place-order-btn w-full bg-primary py-3 rounded-xl text-white font-bold text-lg tracking-widest uppercase flex items-center justify-center gap-3 transition-all">
                            <span class="material-symbols-outlined">send</span>
                            Place Order to Kitchen
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
</div>