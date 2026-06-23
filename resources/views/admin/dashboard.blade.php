<style>
    :root {
        --sa-bg: #f4f5f7;
        --sa-surface: #ffffff;
        --sa-surface2: #f0f1f4;
        --sa-border: rgba(0, 0, 0, 0.08);
        --sa-accent: #6c63ff;
        --sa-accent2: #00a87a;
        --sa-accent3: #e05252;
        --sa-accent4: #d4970a;
        --sa-text: #1a1c23;
        --sa-muted: #6b7280;
        --font-head: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        --font-body: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    * {
        box-sizing: border-box;
    }

    .sa-dashboard {
        font-family: var(--font-body);
        background: var(--sa-bg);
        color: var(--sa-text);
        min-height: 100vh;
        padding: 24px;
    }

    .sa-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 14px;
    }

    .sa-topbar-left h1 {
        font-family: var(--font-head);
        font-size: 24px;
        font-weight: 800;
        color: var(--sa-text);
        margin: 0;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .sa-topbar-left p {
        font-size: 13px;
        color: var(--sa-muted);
        margin: 4px 0 0;
        font-weight: 400;
    }

    .sa-topbar-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sa-badge {
        background: linear-gradient(135deg, var(--sa-accent), #9c8fff);
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 20px;
        letter-spacing: 1px;
        text-transform: uppercase;
        font-family: var(--font-head);
    }

    .sa-date-chip {
        background: var(--sa-surface);
        border: 1px solid var(--sa-border);
        color: var(--sa-muted);
        font-size: 12px;
        font-weight: 500;
        padding: 6px 14px;
        border-radius: 8px;
    }

    .sa-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }

    .sa-stat-card {
        background: var(--sa-surface);
        border: 1px solid var(--sa-border);
        border-radius: 16px;
        padding: 20px;
        position: relative;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
    }

    .sa-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .sa-stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
    }

    .sa-stat-card.c1::before {
        background: linear-gradient(90deg, var(--sa-accent), transparent);
    }

    .sa-stat-card.c2::before {
        background: linear-gradient(90deg, var(--sa-accent2), transparent);
    }

    .sa-stat-card.c3::before {
        background: linear-gradient(90deg, var(--sa-accent3), transparent);
    }

    .sa-stat-card.c4::before {
        background: linear-gradient(90deg, var(--sa-accent4), transparent);
    }

    .sa-stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 14px;
        font-size: 18px;
    }

    .sa-stat-card.c1 .sa-stat-icon {
        background: rgba(108, 99, 255, 0.10);
        color: var(--sa-accent);
    }

    .sa-stat-card.c2 .sa-stat-icon {
        background: rgba(0, 168, 122, 0.10);
        color: var(--sa-accent2);
    }

    .sa-stat-card.c3 .sa-stat-icon {
        background: rgba(224, 82, 82, 0.10);
        color: var(--sa-accent3);
    }

    .sa-stat-card.c4 .sa-stat-icon {
        background: rgba(212, 151, 10, 0.10);
        color: var(--sa-accent4);
    }

    .sa-stat-label {
        font-size: 11px;
        color: var(--sa-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        margin-bottom: 6px;
        font-family: var(--font-head);
    }

    .sa-stat-value {
        font-family: var(--font-head);
        font-size: 28px;
        font-weight: 800;
        color: var(--sa-text);
        line-height: 1;
        margin-bottom: 10px;
        letter-spacing: -0.5px;
    }

    .sa-stat-delta {
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .sa-stat-delta.up {
        color: var(--sa-accent2);
    }

    .sa-stat-delta.down {
        color: var(--sa-accent3);
    }

    .sa-main-grid {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 16px;
        margin-bottom: 16px;
    }

    .sa-card {
        background: var(--sa-surface);
        border: 1px solid var(--sa-border);
        border-radius: 16px;
        padding: 22px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
    }

    .sa-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .sa-card-title {
        font-family: var(--font-head);
        font-size: 15px;
        font-weight: 700;
        color: var(--sa-text);
        letter-spacing: -0.2px;
    }

    .sa-card-sub {
        font-size: 12px;
        color: var(--sa-muted);
        margin-top: 3px;
        font-weight: 400;
    }

    .sa-pill-tabs {
        display: flex;
        gap: 4px;
        background: var(--sa-surface2);
        border-radius: 8px;
        padding: 3px;
    }

    .sa-pill-tab {
        font-size: 11px;
        font-weight: 600;
        padding: 5px 13px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        background: transparent;
        color: var(--sa-muted);
        transition: all 0.2s;
        font-family: var(--font-head);
    }

    .sa-pill-tab.active {
        background: var(--sa-accent);
        color: #fff;
    }

    .sa-bars {
        display: flex;
        align-items: flex-end;
        gap: 8px;
        height: 180px;
        padding-top: 10px;
    }

    .sa-bar-group {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        height: 100%;
        justify-content: flex-end;
    }

    .sa-bar-pair {
        display: flex;
        gap: 3px;
        align-items: flex-end;
        width: 100%;
        justify-content: center;
        height: calc(100% - 22px);
    }

    .sa-bar {
        width: 10px;
        border-radius: 4px 4px 0 0;
        transition: opacity 0.2s;
    }

    .sa-bar:hover {
        opacity: 0.7;
    }

    .sa-bar.primary {
        background: linear-gradient(180deg, var(--sa-accent) 0%, rgba(108, 99, 255, 0.3) 100%);
    }

    .sa-bar.secondary {
        background: linear-gradient(180deg, var(--sa-accent2) 0%, rgba(0, 168, 122, 0.2) 100%);
    }

    .sa-bar-label {
        font-size: 10px;
        font-weight: 500;
        color: var(--sa-muted);
        text-align: center;
        white-space: nowrap;
    }

    .sa-donut-wrap {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .sa-donut {
        position: relative;
        width: 110px;
        height: 110px;
        flex-shrink: 0;
    }

    .sa-donut svg {
        width: 100%;
        height: 100%;
        transform: rotate(-90deg);
    }

    .sa-donut-center {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .sa-donut-pct {
        font-family: var(--font-head);
        font-size: 16px;
        font-weight: 800;
        color: var(--sa-text);
        line-height: 1;
    }

    .sa-donut-lbl {
        font-size: 9px;
        font-weight: 600;
        color: var(--sa-muted);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-top: 3px;
    }

    .sa-legend {
        display: flex;
        flex-direction: column;
        gap: 10px;
        flex: 1;
    }

    .sa-legend-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 12px;
    }

    .sa-legend-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 8px;
        flex-shrink: 0;
    }

    .sa-legend-name {
        color: var(--sa-muted);
        display: flex;
        align-items: center;
        flex: 1;
        font-weight: 500;
    }

    .sa-legend-val {
        color: var(--sa-text);
        font-weight: 700;
        font-family: var(--font-head);
    }

    .sa-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .sa-table th {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--sa-muted);
        padding: 0 10px 12px;
        text-align: left;
        border-bottom: 1px solid var(--sa-border);
        font-family: var(--font-head);
    }

    .sa-table td {
        padding: 12px 10px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        color: var(--sa-text);
        vertical-align: middle;
    }

    .sa-table tr:last-child td {
        border-bottom: none;
    }

    .sa-table tr:hover td {
        background: rgba(0, 0, 0, 0.015);
    }

    .sa-status-pill {
        font-size: 10px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-family: var(--font-head);
    }

    .sa-status-pill.active {
        background: rgba(0, 168, 122, 0.10);
        color: var(--sa-accent2);
    }

    .sa-status-pill.warning {
        background: rgba(212, 151, 10, 0.12);
        color: var(--sa-accent4);
    }

    .sa-status-pill.inactive {
        background: rgba(107, 114, 128, 0.10);
        color: var(--sa-muted);
    }

    .sa-spark {
        display: flex;
        align-items: flex-end;
        gap: 2px;
        height: 24px;
    }

    .sa-spark-bar {
        width: 4px;
        border-radius: 2px;
        opacity: 0.35;
    }

    .sa-spark-bar.hi {
        opacity: 1;
    }

    .sa-tx-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .sa-tx-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sa-tx-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .sa-tx-name {
        flex: 1;
        min-width: 0;
    }

    .sa-tx-title {
        font-size: 13px;
        font-weight: 600;
        color: var(--sa-text);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sa-tx-sub {
        font-size: 11px;
        color: var(--sa-muted);
        margin-top: 2px;
        font-weight: 400;
    }

    .sa-tx-amt {
        font-family: var(--font-head);
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .sa-tx-amt.pos {
        color: var(--sa-accent2);
    }

    .sa-tx-amt.neg {
        color: var(--sa-accent3);
    }

    .sa-bottom-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 16px;
    }

    .sa-progress-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .sa-progress-header {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        margin-bottom: 6px;
        color: var(--sa-muted);
        font-weight: 500;
    }

    .sa-progress-header span:last-child {
        color: var(--sa-text);
        font-weight: 700;
        font-family: var(--font-head);
    }

    .sa-progress-track {
        height: 6px;
        background: var(--sa-surface2);
        border-radius: 99px;
        overflow: hidden;
    }

    .sa-progress-fill {
        height: 100%;
        border-radius: 99px;
        transition: width 1s ease;
    }

    .sa-feed {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .sa-feed-item {
        display: flex;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
    }

    .sa-feed-item:last-child {
        border-bottom: none;
    }

    .sa-feed-dot {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .sa-feed-text {
        font-size: 12px;
        color: var(--sa-muted);
        line-height: 1.6;
        font-weight: 400;
    }

    .sa-feed-text strong {
        color: var(--sa-text);
        font-weight: 600;
    }

    .sa-feed-time {
        font-size: 10px;
        color: var(--sa-muted);
        margin-top: 3px;
        opacity: 0.7;
        font-weight: 500;
    }

    @media (max-width: 1200px) {
        .sa-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .sa-main-grid {
            grid-template-columns: 1fr;
        }

        .sa-bottom-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .sa-dashboard {
            padding: 16px;
        }

        .sa-stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .sa-bottom-grid {
            grid-template-columns: 1fr;
        }

        .sa-stat-value {
            font-size: 22px;
        }
    }

    @media (max-width: 480px) {
        .sa-stats-grid {
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .sa-stat-card {
            padding: 14px;
        }

        .sa-topbar {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="sa-dashboard">
    {{-- TOP BAR --}}
    <div class="sa-topbar">
        <div class="sa-topbar-left">
            <h1>Super Admin Dashboard</h1>
            <p>Overview of all outlets, revenue & operations</p>
        </div>
        <div class="sa-topbar-right">
            <span class="sa-badge">Super Admin</span>
            <span class="sa-date-chip">{{ now()->format('D, d M Y') }}</span>
        </div>
    </div>

    {{-- STAT CARDS --}}
    <div class="sa-stats-grid" style="grid-template-columns: repeat(4, 1fr);">

        <div class="sa-stat-card c1">
            <div class="sa-stat-icon"><i class="bx bx-layer"></i></div>
            <div class="sa-stat-label">Plywoods</div>
            <div class="sa-stat-value">{{ 1 }}</div>
            <div class="sa-stat-delta">Total products</div>
        </div>

        <div class="sa-stat-card c2">
            <div class="sa-stat-icon"><i class="bx bx-door-open"></i></div>
            <div class="sa-stat-label">Doors</div>
            <div class="sa-stat-value">{{ 2 }}</div>
            <div class="sa-stat-delta">Total products</div>
        </div>

        <div class="sa-stat-card c4">
            <div class="sa-stat-icon"><i class="bx bx-grid-alt"></i></div>
            <div class="sa-stat-label">Blockboards</div>
            <div class="sa-stat-value">{{ 3 }}</div>
            <div class="sa-stat-delta">Total products</div>
        </div>

        <div class="sa-stat-card c3">
            <div class="sa-stat-icon"><i class="bx bx-message-detail"></i></div>
            <div class="sa-stat-label">Enquiries</div>
            <div class="sa-stat-value">{{ 4 }}</div>
            <div class="sa-stat-delta">Total received</div>
        </div>

    </div>

    {{-- MAIN GRID --}}


    {{-- BOTTOM GRID --}}


    {{-- CATEGORY PERFORMANCE --}}


</div>

<script>
    document.querySelectorAll('.sa-pill-tab').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.sa-pill-tabs').querySelectorAll('.sa-pill-tab').forEach(b => b.classList
                .remove('active'));
            this.classList.add('active');
        });
    });
</script>
