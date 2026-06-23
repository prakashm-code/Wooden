<style>
    :root {
        --oa-bg:       #f4f5f7;
        --oa-surface:  #ffffff;
        --oa-surface2: #f0f1f4;
        --oa-border:   rgba(0,0,0,0.08);
        --oa-accent:   #6c63ff;
        --oa-green:    #00a87a;
        --oa-red:      #e05252;
        --oa-amber:    #d4970a;
        --oa-blue:     #2e86de;
        --oa-pink:     #c44569;
        --oa-text:     #1a1c23;
        --oa-muted:    #6b7280;
        --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: var(--font);
        background: var(--oa-bg);
        color: var(--oa-text);
        min-height: 100vh;
    }

    .oa-wrap { padding: 28px; }

    /* ── TOPBAR ── */
    .oa-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .oa-topbar-left h1 {
        font-size: 22px;
        font-weight: 800;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }
    .oa-topbar-left p {
        font-size: 12px;
        color: var(--oa-muted);
        margin-top: 4px;
    }
    .oa-topbar-right { display: flex; align-items: center; gap: 10px; }

    .oa-outlet-badge {
        background: linear-gradient(135deg, var(--oa-accent), #9c8fff);
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 5px 14px;
        border-radius: 20px;
        letter-spacing: 0.8px;
        text-transform: uppercase;
    }
    .oa-date-chip {
        background: var(--oa-surface);
        border: 1px solid var(--oa-border);
        color: var(--oa-muted);
        font-size: 12px;
        font-weight: 500;
        padding: 6px 14px;
        border-radius: 8px;
    }
    .oa-live-chip {
        background: rgba(0,168,122,0.10);
        color: var(--oa-green);
        font-size: 11px;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .oa-live-dot {
        width: 6px; height: 6px;
        border-radius: 50%;
        background: var(--oa-green);
        animation: pulse 1.5s infinite;
    }
    @keyframes pulse {
        0%,100% { opacity: 1; transform: scale(1); }
        50%      { opacity: .5; transform: scale(1.4); }
    }

    /* ── SECTION LABEL ── */
    .oa-section-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--oa-muted);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .oa-section-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--oa-border);
    }

    /* ── STAT GRIDS ── */
    .oa-stats-2 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-bottom: 8px;
    }
    .oa-stats-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    /* ── STAT CARD ── */
    .oa-stat {
        background: var(--oa-surface);
        border: 1px solid var(--oa-border);
        border-radius: 16px;
        padding: 20px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        transition: transform .2s, box-shadow .2s;
    }
    .oa-stat:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }
    .oa-stat::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
    }
    .oa-stat.c1::before { background: linear-gradient(90deg, var(--oa-accent), transparent); }
    .oa-stat.c2::before { background: linear-gradient(90deg, var(--oa-green),  transparent); }
    .oa-stat.c3::before { background: linear-gradient(90deg, var(--oa-amber),  transparent); }
    .oa-stat.c4::before { background: linear-gradient(90deg, var(--oa-blue),   transparent); }
    .oa-stat.c5::before { background: linear-gradient(90deg, var(--oa-pink),   transparent); }

    .oa-stat-icon {
        width: 40px; height: 40px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px;
        margin-bottom: 14px;
    }
    .oa-stat.c1 .oa-stat-icon { background: rgba(108,99,255,0.10); color: var(--oa-accent); }
    .oa-stat.c2 .oa-stat-icon { background: rgba(0,168,122,0.10);  color: var(--oa-green); }
    .oa-stat.c3 .oa-stat-icon { background: rgba(212,151,10,0.10); color: var(--oa-amber); }
    .oa-stat.c4 .oa-stat-icon { background: rgba(46,134,222,0.10); color: var(--oa-blue); }
    .oa-stat.c5 .oa-stat-icon { background: rgba(196,69,105,0.10); color: var(--oa-pink); }

    .oa-stat-label {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--oa-muted);
        margin-bottom: 6px;
    }
    .oa-stat-value {
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -0.5px;
        line-height: 1;
        margin-bottom: 8px;
    }
    .oa-stat-delta {
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 3px;
    }
    .oa-stat-delta.up   { color: var(--oa-green); }
    .oa-stat-delta.down { color: var(--oa-red); }
    .oa-stat-delta.neu  { color: var(--oa-muted); }

    .oa-stat-divider {
        height: 1px;
        background: var(--oa-border);
        margin: 12px 0;
    }
    .oa-stat-alltime {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .oa-stat-alltime-label {
        font-size: 10px;
        font-weight: 600;
        color: var(--oa-muted);
        text-transform: uppercase;
        letter-spacing: .6px;
    }
    .oa-stat-alltime-val {
        font-size: 14px;
        font-weight: 800;
        color: var(--oa-text);
    }

    /* ── MAIN GRID ── */
    .oa-main {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    /* ── CARD ── */
    .oa-card {
        background: var(--oa-surface);
        border: 1px solid var(--oa-border);
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.04);
    }
    .oa-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .oa-card-title {
        font-size: 15px;
        font-weight: 700;
        letter-spacing: -0.2px;
    }
    .oa-card-sub {
        font-size: 12px;
        color: var(--oa-muted);
        margin-top: 3px;
    }

    /* ── HOURLY BARS ── */
    .oa-bars {
        display: flex;
        align-items: flex-end;
        gap: 6px;
        height: 160px;
    }
    .oa-bar-group {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 100%;
        justify-content: flex-end;
    }
    .oa-bar-inner {
        display: flex;
        align-items: flex-end;
        width: 100%;
        justify-content: center;
        height: calc(100% - 20px);
    }
    .oa-bar {
        width: 10px;
        border-radius: 3px 3px 0 0;
        transition: opacity .2s;
    }
    .oa-bar:hover { opacity: .7; cursor: pointer; }
    .oa-bar.a   { background: linear-gradient(180deg, var(--oa-accent) 0%, rgba(108,99,255,.2) 100%); }
    .oa-bar.now { background: linear-gradient(180deg, var(--oa-green)  0%, rgba(0,168,122,.15) 100%); }
    .oa-bar-lbl {
        font-size: 9px;
        font-weight: 500;
        color: var(--oa-muted);
        margin-top: 5px;
    }

    /* ── ORDERS LIST ── */
    .oa-orders-list { display: flex; flex-direction: column; gap: 10px; }

    .oa-order-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 13px;
        background: var(--oa-surface2);
        border-radius: 10px;
        transition: background .15s;
        cursor: pointer;
    }
    .oa-order-item:hover { background: #e4e6ed; }

    .oa-order-table {
        width: 36px; height: 36px;
        border-radius: 9px;
        background: var(--oa-accent);
        color: #fff;
        font-size: 11px;
        font-weight: 800;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .oa-order-table.parcel { background: var(--oa-amber); }

    .oa-order-info { flex: 1; min-width: 0; }
    .oa-order-name {
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .oa-order-meta { font-size: 11px; color: var(--oa-muted); margin-top: 2px; }
    .oa-order-amt  { font-size: 13px; font-weight: 700; white-space: nowrap; }

    .oa-order-status {
        font-size: 10px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: .4px;
        flex-shrink: 0;
    }
    .oa-order-status.paid    { background: rgba(0,168,122,0.10); color: var(--oa-green); }
    .oa-order-status.pending { background: rgba(212,151,10,0.12); color: var(--oa-amber); }
    .oa-order-status.active  { background: rgba(108,99,255,0.10); color: var(--oa-accent); }

    /* ── EMPTY STATE ── */
    .oa-empty {
        text-align: center;
        padding: 28px 0;
        color: var(--oa-muted);
        font-size: 13px;
    }
    .oa-empty i {
        font-size: 30px;
        display: block;
        margin-bottom: 8px;
        opacity: .35;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 1100px) {
        .oa-stats-2 { grid-template-columns: repeat(2, 1fr); }
        .oa-stats-3 { grid-template-columns: repeat(3, 1fr); }
        .oa-main    { grid-template-columns: 1fr; }
    }
    @media (max-width: 700px) {
        .oa-wrap       { padding: 16px; }
        .oa-stats-2    { grid-template-columns: 1fr 1fr; }
        .oa-stats-3    { grid-template-columns: 1fr 1fr; }
        .oa-stat-value { font-size: 22px; }
        .oa-topbar     { flex-direction: column; align-items: flex-start; }
    }
    @media (max-width: 480px) {
        .oa-stats-2 { grid-template-columns: 1fr; }
        .oa-stats-3 { grid-template-columns: 1fr; }
    }
</style>

<div class="oa-wrap">

    {{-- ── TOPBAR ── --}}
    <div class="oa-topbar">
        <div class="oa-topbar-left">
            <h1>{{ $outlet->name }} — {{ $outlet->city }}</h1>
            <p>Outlet Admin Dashboard · Today's overview</p>
        </div>
        <div class="oa-topbar-right">
            <div class="oa-live-chip">
                <div class="oa-live-dot"></div> Live
            </div>
            <span class="oa-outlet-badge">Outlet Admin</span>
            <span class="oa-date-chip">{{ now()->format('D, d M Y') }}</span>
        </div>
    </div>

    {{-- ── TODAY'S STATS ── --}}
    <div class="oa-section-label">Today's Stats</div>
    <div class="oa-stats-2">

        {{-- Today Revenue --}}
        <div class="oa-stat c1">
            <div class="oa-stat-icon"><i class='bx bx-rupee'></i></div>
            <div class="oa-stat-label">Today's Revenue</div>
            <div class="oa-stat-value">₹{{ number_format($todayRevenue, 0) }}</div>
            <div class="oa-stat-delta {{ $revenueChange >= 0 ? 'up' : 'down' }}">
                <i class='bx bx-{{ $revenueChange >= 0 ? 'up' : 'down' }}-arrow-alt'></i>
                {{ $revenueChange >= 0 ? '+' : '' }}{{ $revenueChange }}% vs yesterday
            </div>
            <div class="oa-stat-divider"></div>
            <div class="oa-stat-alltime">
                <div class="oa-stat-alltime-label">All Time Total</div>
                <div class="oa-stat-alltime-val">{{ $allTimeRevenue }}</div>
            </div>
        </div>

        {{-- Today Orders --}}
        <div class="oa-stat c2">
            <div class="oa-stat-icon"><i class='bx bx-receipt'></i></div>
            <div class="oa-stat-label">Today's Orders</div>
            <div class="oa-stat-value">{{ $todayOrders }}</div>
            <div class="oa-stat-delta {{ $ordersChange >= 0 ? 'up' : 'down' }}">
                <i class='bx bx-{{ $ordersChange >= 0 ? 'up' : 'down' }}-arrow-alt'></i>
                {{ $ordersChange >= 0 ? '+' : '' }}{{ $ordersChange }} vs yesterday
            </div>
            <div class="oa-stat-divider"></div>
            <div class="oa-stat-alltime">
                <div class="oa-stat-alltime-label">All Time Total</div>
                <div class="oa-stat-alltime-val">{{ number_format($allTimeOrders) }}</div>
            </div>
        </div>

    </div>

    {{-- ── ALL TIME TOTALS ── --}}
    <div class="oa-section-label" style="margin-top: 8px;">All Time Totals</div>
    <div class="oa-stats-3">

        {{-- Total Items Sold — from order_items.quantity SUM --}}
        <div class="oa-stat c3">
            <div class="oa-stat-icon"><i class='bx bx-package'></i></div>
            <div class="oa-stat-label">Total Items Sold</div>
            <div class="oa-stat-value">{{ number_format($allTimeItems) }}</div>
            <div class="oa-stat-delta up">
                <i class='bx bx-up-arrow-alt'></i> Avg {{ $avgItemsPerOrder }} per order
            </div>
        </div>

        {{-- Best Day — grouped from orders.grand_total by DATE --}}
        <div class="oa-stat c4">
            <div class="oa-stat-icon"><i class='bx bx-trophy'></i></div>
            <div class="oa-stat-label">Best Day Revenue</div>
            <div class="oa-stat-value">
                {{ $bestDay ? '₹' . number_format($bestDay->total, 0) : '₹0' }}
            </div>
            <div class="oa-stat-delta neu">
                ↔ {{ $bestDay ? \Carbon\Carbon::parse($bestDay->date)->format('d M Y') : 'N/A' }}
            </div>
        </div>

        {{-- Total Customers — distinct customer_id from orders --}}
        <div class="oa-stat c5">
            <div class="oa-stat-icon"><i class='bx bx-group'></i></div>
            <div class="oa-stat-label">Total Customers</div>
            <div class="oa-stat-value">{{ number_format($totalCustomers) }}</div>
            <div class="oa-stat-delta up">
                <i class='bx bx-up-arrow-alt'></i> +{{ $newCustomersThisMonth }} this month
            </div>
        </div>

    </div>

    {{-- ── MAIN GRID ── --}}
    <div class="oa-main">

        {{-- ── HOURLY REVENUE CHART ── --}}
        <div class="oa-card">
            <div class="oa-card-header">
                <div>
                    <div class="oa-card-title">Hourly Revenue</div>
                    <div class="oa-card-sub">
                        Today ·
                        @if($peakHourVal > 0)
                            Peak at {{ $peakHourLabel }} — ₹{{ number_format($peakHourVal, 0) }}
                        @else
                            No revenue recorded yet
                        @endif
                    </div>
                </div>
                <div style="display:flex;gap:14px;">
                    <div style="display:flex;align-items:center;gap:5px;font-size:11px;font-weight:600;color:var(--oa-muted);">
                        <span style="width:8px;height:8px;border-radius:2px;background:var(--oa-accent);display:inline-block;"></span>
                        Past
                    </div>
                    <div style="display:flex;align-items:center;gap:5px;font-size:11px;font-weight:600;color:var(--oa-muted);">
                        <span style="width:8px;height:8px;border-radius:2px;background:var(--oa-green);display:inline-block;"></span>
                        Now
                    </div>
                </div>
            </div>

            {{-- Bars rendered via Blade — no hardcoded JS values --}}
            <div class="oa-bars">
                @php $maxHr = max($hourlyRevenue) ?: 1; @endphp
                @foreach($hourLabelsMap as $i => $label)
                <div class="oa-bar-group">
                    <div class="oa-bar-inner">
                        <div class="oa-bar {{ $i === $currentHourIndex ? 'now' : 'a' }}"
                             style="height:{{ round(($hourlyRevenue[$i] / $maxHr) * 100) }}%"
                             title="{{ $label }}: ₹{{ number_format($hourlyRevenue[$i], 0) }}">
                        </div>
                    </div>
                    <div class="oa-bar-lbl">{{ $label }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ── TODAY'S ORDERS LIST ── --}}
        <div class="oa-card">
            <div class="oa-card-header">
                <div>
                    <div class="oa-card-title">Today's Orders</div>
                    <div class="oa-card-sub">Most recent 6 orders</div>
                </div>
                <a href="#" style="font-size:11px;font-weight:600;color:var(--oa-accent);text-decoration:none;">
                    View all
                </a>
            </div>

            <div class="oa-orders-list">
                @forelse($recentOrders as $order)
                <div class="oa-order-item">

                    {{-- Badge: T4 for dine_in, PRC for parcel --}}
                    <div class="oa-order-table {{ $order['order_type'] === 'Parcel' ? 'parcel' : '' }}">
                        {{ $order['order_type'] === 'Parcel' ? 'PRC' : 'T'.$order['table_number'] }}
                    </div>

                    <div class="oa-order-info">
                        {{-- order_type + items count + session (lunch/dinner) --}}
                        <div class="oa-order-name">
                            {{ $order['order_type'] }} ·
                            {{ $order['items_count'] }} item{{ $order['items_count'] != 1 ? 's' : '' }} ·
                            {{ $order['session'] }}
                        </div>
                        {{-- customer name + time ago --}}
                        <div class="oa-order-meta">
                            {{ $order['customer'] }} · {{ $order['time'] }}
                        </div>
                    </div>

                    {{-- grand_total from orders.grand_total --}}
                    <div class="oa-order-amt">
                        ₹{{ number_format($order['grand_total'], 0) }}
                    </div>

                    {{-- status: completed = paid, pending = active --}}
                    <div class="oa-order-status {{ $order['status'] }}">
                        {{ $order['status'] }}
                    </div>

                </div>
                @empty
                <div class="oa-empty">
                    <i class='bx bx-receipt'></i>
                    No orders yet today
                </div>
                @endforelse
            </div>
        </div>

    </div>

</div>{{-- end .oa-wrap --}}
