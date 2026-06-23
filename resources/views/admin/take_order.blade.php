{{--
════════════════════════════════════════════════════════
  ROYAL DINE POS  —  Atelier Design System
  Controller: selectTable()  |  JS: pos.js
  Left panel  → Tables grid  (replaces menu cards)
  Right panel → Order panel  (always visible, 400px)
════════════════════════════════════════════════════════
--}}

@php
    $menu              = getThaliWithItems();
    $gstData           = gst_data();
    $getPaymentMethods = getPaymentMethod();
@endphp

{{-- ══════════════ STYLES ══════════════ --}}
<style>
*,*::before,*::after{box-sizing:border-box}
html,body{height:100%;margin:0}

.mi{
  font-family:'Material Symbols Outlined';font-weight:400;font-style:normal;font-size:1.25rem;
  line-height:1;letter-spacing:normal;text-transform:none;white-space:nowrap;direction:ltr;
  -webkit-font-smoothing:antialiased;
  font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;
  display:inline-flex;align-items:center;justify-content:center;vertical-align:middle;
}
.scrollable::-webkit-scrollbar{width:3px}
.scrollable::-webkit-scrollbar-track{background:transparent}
.scrollable::-webkit-scrollbar-thumb{background:rgba(79,70,229,.12);border-radius:8px}
.glass{background:rgba(255,255,255,.80);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px)}

/* ── Layout ── */
.layout-root{display:flex;height:100vh;overflow:hidden;background:#f7f9fb;color:#191c1e;font-family:'Inter',sans-serif;}

/* ── Sidenav ── */
.sidenav{position:fixed;left:0;top:0;height:100%;width:72px;z-index:50;background:#fff;display:flex;flex-direction:column;justify-content:space-between;align-items:center;padding:1.25rem 0;box-shadow:4px 0 20px rgba(25,28,30,.04);}
.nav-icon{display:flex;align-items:center;justify-content:center;width:2.75rem;height:2.75rem;border-radius:1rem;cursor:pointer;transition:background .15s;color:#44474a;border:none;background:transparent;}
.nav-icon.active{background:linear-gradient(135deg,#3525cd,#4f46e5);color:#fff;box-shadow:0 4px 16px rgba(79,70,229,.25);}
.nav-icon:not(.active):hover{background:#eceef0;color:#4f46e5}

/* ── Main ── */
.main-layout{margin-left:72px;display:flex;flex-direction:column;width:calc(100% - 72px);height:100vh;overflow:hidden;}

/* ── Header ── */
.search-bar{background:#f2f4f6;border:none;border-radius:9999px;padding:.5rem 1rem .5rem 2.75rem;font-family:'Inter',sans-serif;font-size:.85rem;color:#191c1e;width:18rem;outline:none;transition:background .15s;}
.search-bar:focus{background:#eceef0}

/* ── Body row ── */
.body-row{display:flex;flex:1;overflow:hidden}

/* ── Left panel ── */
.main-content{flex:1;overflow-y:auto;padding:0 1.5rem 6rem 2.5rem;}

.chip{padding:.5rem 1.25rem;border-radius:9999px;font-family:'Manrope',sans-serif;font-weight:700;font-size:.7rem;letter-spacing:.08em;text-transform:uppercase;cursor:pointer;border:none;transition:background .15s,color .15s;background:#eceef0;color:#44474a;white-space:nowrap;}
.chip.active{background:linear-gradient(135deg,#3525cd,#4f46e5);color:#fff;box-shadow:0 4px 12px rgba(79,70,229,.20);}
.chip:not(.active):hover{background:#e2dfff;color:#3525cd}
.filter-scroll{display:flex;gap:.6rem;overflow-x:auto;padding-bottom:4px;scrollbar-width:none}
.filter-scroll::-webkit-scrollbar{display:none}

/* ── Table cards ── */
.table-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:14px;padding-top:1rem;}
.t-card{border-radius:1.5rem;padding:14px 12px 12px;position:relative;cursor:pointer;transition:transform .2s,box-shadow .2s;overflow:hidden;min-height:145px;display:flex;flex-direction:column;justify-content:space-between;text-decoration:none !important;user-select:none;border:1.5px solid transparent;box-shadow:0 4px 16px rgba(25,28,30,.04);}
.t-card:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(25,28,30,.09)}
.t-card:active{transform:scale(.98)}
.t-card.vacant{background:#e8faf2;border-color:#a7f3d0}
.t-card.vacant .t-num{color:#065f46}.t-card.vacant .t-badge{background:#10b981;color:#fff}.t-card.vacant .t-amt{color:#059669}
.t-card.running{background:#dbeafe;border-color:#93c5fd}
.t-card.running .t-num{color:#1e3a5f}.t-card.running .t-badge{background:#3b82f6;color:#fff}.t-card.running .t-amt{color:#1d4ed8}.t-card.running .t-timer{color:#1e40af}.t-card.running .t-meta{color:#3b82f6}
.t-card.longwait{background:#fff7ed;border-color:#fdba74}
.t-card.longwait .t-num{color:#7c2d12}.t-card.longwait .t-badge{background:#f97316;color:#fff}.t-card.longwait .t-amt{color:#c2410c}.t-card.longwait .t-timer{color:#c2410c}.t-card.longwait .t-meta{color:#f97316}
.t-card.table-active{box-shadow:0 0 0 3px rgba(79,70,229,.4),0 6px 20px rgba(0,0,0,.1) !important;transform:translateY(-2px);}
.t-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:6px}
.t-badge{font-size:9px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;padding:3px 8px;border-radius:9999px}
.t-num{font-size:38px;font-weight:900;line-height:1;text-align:center;letter-spacing:-1px;margin:4px 0 2px}
.t-timer{font-size:11px;font-weight:700;text-align:center;letter-spacing:.04em;min-height:16px}
.t-bottom{display:flex;align-items:center;justify-content:space-between;margin-top:8px}
.t-meta{font-size:10px;font-weight:700;letter-spacing:.04em}
.t-amt{font-size:13px;font-weight:800}

/* ── Right: order panel ── */
.right-panel{width:400px;flex-shrink:0;background:#f2f4f6;display:flex;flex-direction:column;overflow:hidden;}
.order-type-wrap{display:flex;background:#eceef0;border-radius:1rem;padding:4px;}
.order-type-btn{flex:1;padding:.6rem 1rem;border-radius:.75rem;font-family:'Manrope',sans-serif;font-weight:700;font-size:.8rem;border:none;cursor:pointer;transition:background .15s,color .15s,box-shadow .15s;color:#44474a;background:transparent;}
.order-type-btn.active{background:#fff;color:#3525cd;box-shadow:0 2px 8px rgba(25,28,30,.06);}
.table-chip{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:2px;padding:.6rem .4rem;border-radius:1rem;cursor:pointer;transition:background .15s,box-shadow .15s;min-width:0;border:none;}
.table-chip.vacant{background:#e2dfff}
.table-chip.active{background:linear-gradient(135deg,#3525cd,#4f46e5);box-shadow:0 6px 18px rgba(79,70,229,.28)}
.table-chip.vacant:hover{background:#cbc8f5}
.cart-row{background:#fff;border-radius:1rem;box-shadow:0 2px 8px rgba(25,28,30,.04);}
.qty-btn{width:1.6rem;height:1.6rem;border-radius:50%;display:flex;align-items:center;justify-content:center;border:none;cursor:pointer;font-weight:700;font-size:1rem;transition:background .12s;}
.qty-btn.minus,.btn_minus{background:#f2f4f6;color:#44474a}
.qty-btn.plus,.btn_plus{background:linear-gradient(135deg,#3525cd,#4f46e5);color:#fff}
.qty-btn.plus:hover,.btn_plus:hover{filter:brightness(1.1)}
.qty-btn.minus:hover,.btn_minus:hover{background:#eceef0}
.btn_plus,.btn_minus{width:1.6rem;height:1.6rem;border-radius:50%;display:flex;align-items:center;justify-content:center;border:none;cursor:pointer;font-weight:700;font-size:1rem;transition:background .12s;}
.summary-row{display:flex;justify-content:space-between;align-items:center}
.btn-cta{background:linear-gradient(135deg,#3525cd 0%,#4f46e5 100%);border-radius:1.5rem;color:#fff;font-family:'Manrope',sans-serif;font-weight:800;font-size:1rem;letter-spacing:.02em;border:none;cursor:pointer;transition:filter .18s,transform .1s;position:relative;overflow:hidden;}
.btn-cta::after{content:'';position:absolute;inset:0;border-radius:inherit;box-shadow:inset 0 0 0 1.5px rgba(255,255,255,0);transition:box-shadow .18s}
.btn-cta:hover{filter:brightness(1.08)}.btn-cta:hover::after{box-shadow:inset 0 0 0 1px rgba(255,255,255,.18)}.btn-cta:active{transform:scale(.985)}.btn-cta:disabled{opacity:.5;cursor:not-allowed;filter:none}
.btn-outline{padding:.75rem;border-radius:1rem;background:#fff;color:#191c1e;font-family:'Manrope',sans-serif;font-weight:700;font-size:.7rem;letter-spacing:.06em;text-transform:uppercase;border:none;cursor:pointer;box-shadow:0 2px 8px rgba(25,28,30,.05);transition:background .14s,box-shadow .14s;display:flex;align-items:center;justify-content:center;gap:4px;}
.btn-outline:hover{background:#f7f9fb;box-shadow:0 4px 12px rgba(25,28,30,.08)}
@keyframes kotPulse{0%,100%{box-shadow:0 0 0 0 rgba(79,70,229,.35)}50%{box-shadow:0 0 0 7px rgba(79,70,229,0)}}
#kotBtn{animation:kotPulse 1.8s infinite}
@keyframes shake{0%,100%{transform:translateX(0)}25%{transform:translateX(-3px)}75%{transform:translateX(3px)}}
.btn-at-min{animation:shake .3s ease;color:#ef4444 !important}
.badge-new{display:inline-block;font-size:9px;font-weight:800;letter-spacing:.06em;color:#fff;background:#4f46e5;border-radius:4px;padding:1px 5px;margin-left:5px;vertical-align:middle;}
.tag-parcel{display:inline-block;font-size:9px;font-weight:700;background:#fef3c7;color:#92400e;border-radius:3px;padding:1px 5px;margin-left:5px;vertical-align:middle;}
.row-toggle{display:inline-flex;background:#f1f5f9;border-radius:5px;padding:2px;gap:2px;margin-top:4px;}
.row-toggle button{padding:2px 9px;font-size:9px;font-weight:800;letter-spacing:.04em;border-radius:3px;border:none;cursor:pointer;color:#94a3b8;background:transparent;transition:all .15s;}
.row-toggle button.active{background:#fff;color:#4f46e5;box-shadow:0 1px 3px rgba(0,0,0,.12)}
.btn-remove-item{width:1.25rem;height:1.25rem;border-radius:50%;background:#f2f4f6;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#44474a;transition:background .12s,color .12s;flex-shrink:0;}
.btn-remove-item:hover{background:#fee2e2;color:#ef4444}
.item-name{font-size:.82rem;font-weight:700;color:#191c1e}
.price{font-size:.8rem;color:#44474a}
.row-total{font-size:.85rem;font-weight:700;color:#191c1e}
.qty-display{font-weight:700;font-size:.95rem;text-align:center;min-width:1.2rem}

/* payment dropdown */
.payment-dropdown{position:relative}
.payment-dropdown-menu{display:none;position:absolute;bottom:calc(100% + 6px);left:0;width:100%;background:#fff;border:1px solid #e2e8f0;border-radius:.75rem;box-shadow:0 8px 24px rgba(0,0,0,.10);z-index:60;overflow:hidden;}
.payment-dropdown-menu.open{display:block}
.payment-option{display:flex;align-items:center;gap:10px;padding:10px 14px;font-size:13px;font-weight:600;cursor:pointer;transition:background .15s;color:#334155;}
.payment-option:hover{background:#f8fafc}
.payment-option.selected{color:#4f46e5;background:#e2dfff}

/* Settlement modal */
#settlementModal{display:none;position:fixed;inset:0;background:rgba(0,0,0,.55);z-index:200;align-items:center;justify-content:center;padding:16px;}
#settlementModal.open{display:flex}
.settle-box{background:#fff;border-radius:1rem;width:100%;max-width:540px;box-shadow:0 24px 60px rgba(0,0,0,.22);overflow:hidden;animation:settleFadeIn .2s ease;}
@keyframes settleFadeIn{from{opacity:0;transform:scale(.96) translateY(8px)}to{opacity:1;transform:scale(1) translateY(0)}}
.settle-header{display:flex;align-items:center;justify-content:space-between;padding:18px 24px 14px;border-bottom:1px solid #f1f5f9;}
.settle-title{font-size:17px;font-weight:700;color:#1e293b}
.settle-title span{color:#4f46e5;font-size:15px;font-weight:600;margin-left:6px}
.settle-close{width:30px;height:30px;border-radius:50%;border:none;background:#f1f5f9;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#64748b;transition:background .12s;}
.settle-close:hover{background:#fee2e2;color:#ef4444}
.settle-body{padding:20px 24px}
.settle-pay-label{font-size:10px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#94a3b8;margin-bottom:10px;display:block}
.settle-pay-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:20px}
.settle-pay-pill{display:flex;align-items:center;gap:6px;padding:6px 14px;border:1.5px solid #e2e8f0;border-radius:999px;cursor:pointer;font-size:12px;font-weight:600;color:#475569;background:#fff;transition:.12s;user-select:none;}
.settle-pay-pill input[type="radio"]{width:13px;height:13px;accent-color:#4f46e5;cursor:pointer}
.settle-pay-pill.pay-active{border-color:#4f46e5;background:#e2dfff;color:#3525cd}
.settle-fields{display:flex;flex-direction:column;gap:12px}
.settle-row{display:flex;align-items:center;justify-content:space-between;gap:12px}
.settle-row label{font-size:13px;font-weight:600;color:#475569;min-width:150px;flex-shrink:0}
.settle-input{flex:1;padding:9px 14px;border:1.5px solid #e2e8f0;border-radius:9px;font-size:14px;font-weight:600;color:#1e293b;background:#f8fafc;outline:none;transition:border-color .12s;}
.settle-input:focus{border-color:#4f46e5;background:#fff}
.settle-input.readonly-field{background:#f1f5f9;color:#64748b;font-weight:700;cursor:default}
.settle-input.highlight-field{background:#fff;color:#4f46e5;font-size:16px;font-weight:800}
.settle-divider{border:none;border-top:1px dashed #e2e8f0;margin:4px 0 8px}
#partPaymentSection{display:none;margin-top:4px}#partPaymentSection.show{display:block}
.part-section-label{font-size:10px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#94a3b8;margin-bottom:10px;display:block}
.part-rows{display:flex;flex-direction:column;gap:8px}
.part-row{display:flex;align-items:center;gap:8px}
.part-method-label{font-size:12px;font-weight:700;color:#475569;min-width:80px;flex-shrink:0}
.part-input{flex:1;padding:8px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:13px;font-weight:600;color:#1e293b;background:#f8fafc;outline:none;transition:border-color .12s;}
.part-input:focus{border-color:#4f46e5;background:#fff}
.part-remaining-wrap{display:flex;align-items:center;justify-content:space-between;margin-top:10px;padding:8px 12px;background:#f8fafc;border-radius:8px;border:1px solid #e2e8f0;}
.part-remaining-label{font-size:12px;font-weight:600;color:#64748b}
.part-remaining-val{font-size:14px;font-weight:800;color:#4f46e5}
.part-remaining-val.zero{color:#10b981}
.settle-footer{display:flex;align-items:center;justify-content:flex-end;gap:10px;padding:14px 24px 20px;border-top:1px solid #f1f5f9;}
.settle-cancel-btn{padding:10px 22px;border-radius:9px;border:1.5px solid #e2e8f0;background:#fff;font-size:13px;font-weight:600;color:#64748b;cursor:pointer;transition:background .12s;}
.settle-cancel-btn:hover{background:#f8fafc}
.settle-save-btn{padding:10px 28px;border-radius:9px;border:none;background:linear-gradient(135deg,#3525cd,#4f46e5);color:#fff;font-size:13px;font-weight:700;letter-spacing:.04em;cursor:pointer;display:flex;align-items:center;gap:7px;transition:filter .12s,transform .1s;}
.settle-save-btn:hover{filter:brightness(1.08)}.settle-save-btn:active{transform:scale(.98)}.settle-save-btn:disabled{opacity:.55;cursor:not-allowed}

/* suggestion dropdown */
#suggestions_name,#suggestions_phone{position:absolute;z-index:50;width:100%;background:#fff;border:1px solid #e2e8f0;border-radius:.6rem;box-shadow:0 8px 24px rgba(0,0,0,.10);margin-top:4px;max-height:180px;overflow-y:auto;}

/* mobile fab */
.mobile-order-fab{display:none;position:fixed;bottom:1.5rem;right:1.5rem;z-index:60;}
@media(max-width:900px){.right-panel{display:none !important}.mobile-order-fab{display:flex !important}.main-content{padding-right:1rem !important}}
@media(max-width:640px){.sidenav{display:none}.main-layout{margin-left:0 !important}.header-search{display:none !important}}
</style>

{{-- ══ SETTLEMENT MODAL ══ --}}
<div id="settlementModal">
  <div class="settle-box">
    <div class="settle-header">
      <p class="settle-title">Settle &amp; Save <span id="settle-amount-label"></span></p>
      <button class="settle-close" onclick="closeSettlementModal()"><span class="mi" style="font-size:16px;">close</span></button>
    </div>
    <div class="settle-body">
      <span class="settle-pay-label">Payment Type</span>
      <div class="settle-pay-pills" id="settlePills">
        @foreach($getPaymentMethods as $method)
        <label class="settle-pay-pill {{ $loop->first ? 'pay-active' : '' }}">
          <input type="radio" name="settle_payment" value="{{ $method->id }}" data-name="{{ $method->name }}" {{ $loop->first ? 'checked' : '' }} onchange="onSettlePaymentChange(this)">
          {{ $method->name }}
        </label>
        @endforeach
      </div>
      <div id="standardPaySection">
        <div class="settle-fields">
          <div class="settle-row"><label>Customer Paid</label><input type="number" id="settle-paid" class="settle-input" placeholder="0" min="0" oninput="onSettlePaidInput(this.value)"></div>
          <hr class="settle-divider">
          <div class="settle-row"><label>Return to Customer</label><input type="text" id="settle-return" class="settle-input readonly-field" readonly value="0.00"></div>
          <div class="settle-row"><label>Tip</label><input type="number" id="settle-tip" class="settle-input" placeholder="0" min="0" value="0" oninput="onSettleTipInput(this.value)"></div>
          <hr class="settle-divider">
          <div class="settle-row"><label>Settlement Amount</label><input type="text" id="settle-settlement" class="settle-input highlight-field" readonly value=""></div>
        </div>
      </div>
      <div id="partPaymentSection">
        <span class="part-section-label">Split Payment by Method</span>
        <div class="part-rows" id="partRows"></div>
        <div class="part-remaining-wrap" style="margin-top:12px;"><span class="part-remaining-label">Remaining to allocate</span><span class="part-remaining-val" id="partRemaining">₹0.00</span></div>
      </div>
    </div>
    <div class="settle-footer">
      <button class="settle-cancel-btn" onclick="closeSettlementModal()">Cancel</button>
      <button class="settle-save-btn" id="settle-save-btn" onclick="submitSettlement()">
        <span class="mi" style="font-size:16px;">check_circle</span>Settle &amp; Save
      </button>
    </div>
  </div>
</div>

{{-- ══ LAYOUT ROOT ══ --}}
<div class="layout-root">

  {{-- ── SIDE NAV ── --}}
  <nav class="sidenav">
    <div style="display:flex;flex-direction:column;align-items:center;gap:.15rem;margin-bottom:1.5rem;">
      <div style="width:2.5rem;height:2.5rem;border-radius:.875rem;background:linear-gradient(135deg,#3525cd,#4f46e5);display:flex;align-items:center;justify-content:center;">
        <span class="mi" style="color:#fff;font-size:1.25rem;">restaurant</span>
      </div>
    </div>
    <div style="display:flex;flex-direction:column;align-items:center;gap:.5rem;flex:1;">
      <button class="nav-icon active" title="Tables"><span class="mi">table_restaurant</span></button>
      <button class="nav-icon" title="Menu"><span class="mi">restaurant_menu</span></button>
      <button class="nav-icon" title="Wine"><span class="mi">wine_bar</span></button>
      <button class="nav-icon" title="Bar"><span class="mi">local_bar</span></button>
      <button class="nav-icon" title="Desserts"><span class="mi">cake</span></button>
      <button class="nav-icon" title="Quick Bites"><span class="mi">takeout_dining</span></button>
    </div>
    <div style="display:flex;flex-direction:column;align-items:center;gap:.5rem;padding-top:1rem;">
      <button class="nav-icon" title="Settings"><span class="mi" style="font-size:1.1rem;">settings</span></button>
      <button class="nav-icon" title="Help"><span class="mi" style="font-size:1.1rem;">help_outline</span></button>
    </div>
  </nav>

  {{-- ── MAIN ── --}}
  <div class="main-layout">

    {{-- Hidden inputs for pos.js --}}
    <input type="hidden" id="parcel_charge"   value="{{ $parcel }}">
    <input type="hidden" class="parcel_charge" value="{{ $parcel }}">

    {{-- ── HEADER ── --}}
    <header class="glass" style="position:sticky;top:0;z-index:40;padding:.875rem 2rem .875rem 2.5rem;display:flex;justify-content:space-between;align-items:center;flex-shrink:0;">
      <div style="display:flex;align-items:center;gap:.75rem;">
        <span style="font-family:'Manrope',sans-serif;font-size:1.25rem;font-weight:800;letter-spacing:-.02em;color:#3525cd;">Royal Dine</span>
      </div>
      <div class="header-search" style="position:relative;">
        <span class="mi" style="position:absolute;left:.875rem;top:50%;transform:translateY(-50%);color:#44474a;font-size:1rem;">search</span>
        <input class="search-bar" placeholder="Search tables…" type="text" id="tableSearch" oninput="searchTables(this.value)"/>
      </div>
      <div style="display:flex;align-items:center;gap:1rem;">
        <button class="nav-icon" style="width:2.2rem;height:2.2rem;" title="Wifi"><span class="mi" style="font-size:1.1rem;">wifi</span></button>
        <div style="background:#f2f4f6;border-radius:.875rem;padding:.4rem .75rem;display:flex;align-items:center;gap:.6rem;">
          <div style="text-align:right;">
            <p style="font-family:'Manrope',sans-serif;font-size:.65rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:#4f46e5;line-height:1.2;">Station</p>
            <p style="font-size:.6rem;color:#44474a;margin-top:1px;">{{ auth()->user()->name ?? 'Staff' }}</p>
          </div>
          <div style="width:2.25rem;height:2.25rem;border-radius:50%;overflow:hidden;background:#e2dfff;">
            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBgMCzqL4LUKXHFJFXizsweB8sjUcdScna7PUSb1IdzAeW-NaGAfEz3H20m0TyFcvE-rJQG3YHIGLH_o2DyxlUK8mgw03wr76lNuwxWSDKn7lYYXjR3g_GUkV_NwLS5zeLvNgeG-0ao30owsCulygncZvqlWwqZdvVvPnKKTfcUoXwbDhEkFHBksW6URZI8j4Chi495YM1k9ihpjOIvQSU83lJfw_hPvNnfJNk3Ins6B1UC9I8_htqMixOds-zejbWrXPgNXcCyL4CC"
              alt="{{ auth()->user()->name }}" style="width:100%;height:100%;object-fit:cover;"/>
          </div>
        </div>
      </div>
    </header>

    {{-- ── BODY ROW ── --}}
    <div class="body-row">

      {{-- ══ LEFT: TABLES ══ --}}
      <section class="main-content scrollable">
        <div class="glass" style="position:sticky;top:0;z-index:30;padding:1.25rem 0 1rem;margin:0 -.5rem;padding-left:.5rem;padding-right:.5rem;">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;">
            <h2 style="font-family:'Manrope',sans-serif;font-size:2rem;font-weight:800;letter-spacing:-.02em;color:#191c1e;line-height:1.1;">Tables</h2>
            <div style="display:flex;gap:.4rem;background:#f2f4f6;border-radius:.75rem;padding:3px;">
              <button onclick="setView('grid',this)" style="background:#fff;border:none;border-radius:.6rem;padding:.4rem .6rem;cursor:pointer;">
                <span class="mi" style="color:#4f46e5;font-size:1.1rem;">grid_view</span>
              </button>
              <button onclick="setView('list',this)" style="background:transparent;border:none;border-radius:.6rem;padding:.4rem .6rem;cursor:pointer;">
                <span class="mi" style="color:#44474a;font-size:1.1rem;">view_list</span>
              </button>
            </div>
          </div>
          <div class="filter-scroll">
            <button class="chip active" onclick="filterTables(this,'all')">All Tables</button>
            <button class="chip" onclick="filterTables(this,'vacant')">Vacant</button>
            <button class="chip" onclick="filterTables(this,'running')">Occupied</button>
            <button class="chip" onclick="filterTables(this,'longwait')">Long Wait</button>
          </div>
        </div>

        <div class="table-grid" id="tableGrid">
          @foreach($tables as $table)
            @php
              $isOccupied = $table->occupied == 1;
              $cls        = $isOccupied ? 'running' : 'vacant';
              $badgeText  = $isOccupied ? 'Occupied' : 'Vacant';
            @endphp
            <a href="{{ !$isOccupied ? route('take_order', ['table' => encrypt($table->id), 'table_number' => $table->table_number]) : 'javascript:void(0);' }}"
              class="table-card t-card {{ $cls }}"
              data-occupied="{{ $table->occupied }}"
              data-id="{{ $table->id }}"
              data-number="{{ $table->table_number }}"
              data-status="{{ $cls }}"
              @if($isOccupied) data-created="{{ \Carbon\Carbon::parse($table->latest_order_time)->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s') }}" @endif>
              <div class="t-top">
                <span class="t-badge">{{ $badgeText }}</span>
              </div>
              <div class="t-num">{{ str_pad($table->table_number, 2, '0', STR_PAD_LEFT) }}</div>
              <div class="t-timer" id="timer-{{ $table->id }}">@if(!$isOccupied)—@endif</div>
              <div class="t-bottom">
                <span class="t-meta">{{ $isOccupied ? ($table->items_count ?? 0).' items' : '' }}</span>
                <span class="t-amt">₹{{ number_format($table->grand_total ?? 0) }}</span>
              </div>
            </a>
          @endforeach
        </div>
      </section>

      {{-- ══ RIGHT: ORDER PANEL (always visible, exact Atelier layout) ══ --}}
      <aside class="right-panel">

        {{-- Order type toggle — toggle-box class required by pos.js --}}
        <div style="padding:1.25rem 1.25rem .75rem;">
          <div class="order-type-wrap toggle-box">
            <button class="order-type-btn active" data-type="dine_in">Dine In</button>
            <button class="order-type-btn" data-type="parcel">Parcel</button>
          </div>
        </div>

        {{-- Table chips grid — shows all tables, max 8 --}}
        <div style="padding:0 1.25rem 1rem;display:grid;grid-template-columns:repeat(4,1fr);gap:.5rem;" id="tablePills">
          @foreach($tables->take(8) as $t)
          @php $occ = $t->occupied==1; @endphp
          <button class="table-chip {{ $occ ? '' : 'vacant' }}"
            onclick="selectTablePanel(this,'{{ $t->id }}','{{ $t->table_number }}')"
            data-id="{{ $t->id }}" data-number="{{ $t->table_number }}" data-occupied="{{ $t->occupied }}"
            style="{{ $occ ? 'background:#dbeafe;' : '' }}">
            <span style="font-family:'Manrope',sans-serif;font-size:1.1rem;font-weight:800;line-height:1;color:{{ $occ ? '#1e3a5f' : '#3525cd' }};">
              T-{{ str_pad($t->table_number,2,'0',STR_PAD_LEFT) }}
            </span>
            <span style="font-size:.5rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:{{ $occ ? '#3b82f6' : '#4f46e5' }};">
              {{ $occ ? 'Active' : 'Open' }}
            </span>
          </button>
          @endforeach
        </div>

        {{-- Order header --}}
        <div style="padding:0 1.25rem .75rem;display:flex;justify-content:space-between;align-items:baseline;">
          <h3 style="font-family:'Manrope',sans-serif;font-size:1.05rem;font-weight:800;color:#191c1e;letter-spacing:-.01em;">
            Current Order
          </h3>
          <span style="font-size:.7rem;color:#44474a;">T-<span id="order_table_no">—</span></span>
        </div>

        {{-- Customer fields (hidden for waiter) --}}
        @if(auth()->user()->role !== 'waiter')
        <div style="padding:0 1.25rem .75rem;display:grid;grid-template-columns:1fr 1fr;gap:.5rem;">
          <div style="position:relative;">
            <input id="customer_name" type="text" placeholder="Customer name…" autocomplete="off"
              oninput="searchCustomer('name',this.value)"
              style="width:100%;background:#fff;border:none;border-radius:.75rem;padding:.5rem .75rem;font-size:.78rem;color:#191c1e;outline:none;box-shadow:0 2px 8px rgba(25,28,30,.04);">
            <div id="suggestions_name" class="hidden" style="position:absolute;top:100%;left:0;right:0;z-index:50;"></div>
          </div>
          <div style="position:relative;">
            <input id="customer_phone" type="text" placeholder="Mobile…" autocomplete="off"
              oninput="searchCustomer('phone',this.value)"
              style="width:100%;background:#fff;border:none;border-radius:.75rem;padding:.5rem .75rem;font-size:.78rem;color:#191c1e;outline:none;box-shadow:0 2px 8px rgba(25,28,30,.04);">
            <div id="suggestions_phone" class="hidden" style="position:absolute;top:100%;left:0;right:0;z-index:50;"></div>
          </div>
        </div>
        @endif

        {{-- Thali / item strip for pos.js asideAddThali() --}}
        <div style="padding:0 1.25rem .75rem;border-bottom:1px solid #eceef0;">
          <p style="font-size:.6rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#94a3b8;margin-bottom:8px;">Add Items</p>
          <div style="display:flex;gap:.5rem;overflow-x:auto;padding-bottom:4px;scrollbar-width:none;">
            @foreach($menu as $thali)
            <button type="button"
              class="thali-strip-btn"
              data-id="{{ $thali->id }}"
              data-name="{{ $thali->name }}"
              data-price="{{ $thali->price }}"
              data-parcel="{{ $thali->parcel_price ?? 0 }}"
              onclick="asideAddThali(this)"
              style="flex-shrink:0;display:flex;flex-direction:column;align-items:center;gap:2px;background:#fff;border:none;border-radius:.875rem;padding:.5rem .75rem;cursor:pointer;min-width:72px;text-align:center;box-shadow:0 2px 8px rgba(25,28,30,.04);transition:background .14s;">
              <span style="font-size:.7rem;font-weight:700;color:#191c1e;line-height:1.3;">{{ $thali->name }}</span>
              <span style="font-size:.65rem;font-weight:600;color:#4f46e5;">₹{{ number_format($thali->price,0) }}</span>
            </button>
            @endforeach
          </div>
        </div>

        {{-- Cart list — pos.js writes into #order_items --}}
        <div id="cartList" class="scrollable" style="flex:1;overflow-y:auto;padding:0 1.25rem;display:flex;flex-direction:column;gap:.6rem;padding-top:.75rem;">
          <table style="width:100%;border-collapse:collapse;">
            <thead>
              <tr style="font-size:.6rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:#94a3b8;border-bottom:1px solid #eceef0;">
                <th style="padding:.5rem 0;text-align:left;font-weight:700;">Item</th>
                <th style="padding:.5rem 0;text-align:center;font-weight:700;">Qty</th>
                <th style="padding:.5rem 0;text-align:right;font-weight:700;">Total</th>
              </tr>
            </thead>
            <tbody id="order_items">
              <tr id="emptyRow">
                <td colspan="3" style="padding:2.5rem 0;text-align:center;font-size:.85rem;color:#94a3b8;">
                  Select a table to view its order
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        {{-- ── FOOTER ── --}}
        <div style="background:#fff;padding:1.125rem 1.25rem 1.25rem;box-shadow:0 -8px 24px rgba(25,28,30,.04);">

          {{-- Summary --}}
          <div style="display:flex;flex-direction:column;gap:.45rem;margin-bottom:.875rem;">
            <div class="summary-row" style="font-size:.8rem;color:#44474a;">
              <span id="subtotal_label">Subtotal</span>
              <span style="font-weight:700;color:#191c1e;" id="subtotal">₹0</span>
            </div>
            @foreach($gstData as $gst)
            <div class="summary-row total_payable" style="font-size:.8rem;color:#44474a;">
              <span>{{ $gst->name }} ({{ $gst->percentage }}%)</span>
              <span style="font-weight:700;color:#191c1e;" id="{{ strtolower($gst->name) }}">₹0</span>
              <input type="hidden" name="tax_id[]"         value="{{ $gst->id }}">
              <input type="hidden" name="tax_percentage[]" value="{{ $gst->percentage }}">
            </div>
            @endforeach
            <div id="parcelRow" class="summary-row" style="font-size:.8rem;color:#44474a;display:none;">
              <span>Parcel Charges</span>
              <span style="font-weight:700;color:#191c1e;" id="parcelTotal">₹0</span>
            </div>
            <div class="summary-row" style="padding-top:.75rem;margin-top:.25rem;border-top:1.5px dashed #eceef0;">
              <span style="font-family:'Manrope',sans-serif;font-weight:800;font-size:1rem;color:#191c1e;">Total Due</span>
              <span style="font-family:'Manrope',sans-serif;font-weight:800;font-size:1.4rem;color:#4f46e5;" id="grandTotal">₹0</span>
            </div>
            <span id="grand_Total" style="display:none;">0</span>
          </div>

          {{-- Repeat + KOT --}}
          <button id="repeatOrderBtn" style="display:none;width:100%;margin-bottom:.5rem;" class="btn-outline">
            <span class="mi" style="font-size:.9rem;margin-right:4px;">replay</span>Repeat Order
          </button>
          <button id="kotBtn" style="display:none;width:100%;margin-bottom:.75rem;" class="btn-outline">
            <span class="mi" style="font-size:.9rem;margin-right:4px;">receipt_long</span>Print KOT
            <span id="kotNewCount" style="background:#4f46e5;color:#fff;font-size:.65rem;font-weight:700;padding:1px 8px;border-radius:9999px;margin-left:4px;">0 new</span>
          </button>

          {{-- Secondary grid buttons (hidden for waiter) --}}
          @if(auth()->user()->role !== 'waiter')
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:.6rem;margin-bottom:.75rem;">
            <div class="payment-dropdown">
              <div class="payment-dropdown-menu" id="paymentMenu">
                @foreach($getPaymentMethods as $methods)
                <div class="payment-option {{ $loop->first ? 'selected' : '' }}"
                  data-value="{{ $methods->id }}" data-icon="payments">
                  <span class="mi" style="font-size:1rem;">payments</span>{{ $methods->name }}
                </div>
                @endforeach
              </div>
              <div id="paymentTrigger" class="btn-outline" style="justify-content:flex-start;gap:.4rem;cursor:pointer;">
                <span class="mi" style="color:#4f46e5;font-size:.9rem;margin-right:2px;" id="paymentIcon">payments</span>
                <span id="paymentLabel" style="flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-size:.68rem;">
                  {{ $getPaymentMethods->first()->name ?? 'Cash' }}
                </span>
                <span class="mi" style="color:#44474a;font-size:.9rem;" id="paymentChevron">expand_more</span>
              </div>
              <input type="hidden" id="payment_type" value="{{ $getPaymentMethods->first()->id ?? '' }}">
            </div>
            <button class="btn-outline" onclick="openSettlementModal()">
              <span class="mi" style="font-size:.9rem;margin-right:4px;">receipt_long</span>Place Order
            </button>
          </div>

          {{-- Primary CTA --}}
          <button class="btn-cta place-order-btn"
            style="width:100%;padding:1rem 1.5rem;font-size:1rem;display:flex;align-items:center;justify-content:center;gap:.5rem;"
            onclick="openSettlementModal()">
            Proceed to Payment
            <span class="mi" style="font-size:1.1rem;">arrow_forward</span>
          </button>
          @endif

        </div>{{-- /footer --}}
      </aside>{{-- /right-panel --}}

    </div>{{-- /body-row --}}
  </div>{{-- /main-layout --}}
</div>{{-- /layout-root --}}

{{-- Mobile FAB --}}
<div class="mobile-order-fab">
  <button class="btn-cta" style="padding:.875rem 1.5rem;font-size:.9rem;display:flex;align-items:center;gap:.5rem;box-shadow:0 8px 24px rgba(53,37,205,.35);" onclick="toggleMobilePanel()">
    <span class="mi">shopping_bag</span>View Order
    <span id="mobileCartCount" style="background:rgba(255,255,255,.25);border-radius:9999px;padding:1px 8px;font-size:.7rem;">0</span>
  </button>
</div>

{{-- ══ PAGE-LEVEL SCRIPTS ══ --}}
<script>
/* ─── Variables pos.js needs ─── */
const _paymentMethods = @json($getPaymentMethods->map(fn($m) => ['id' => $m->id, 'name' => $m->name]));

/* ─── Table timers ─── */
function fmtTimer(sec){const h=Math.floor(sec/3600),m=Math.floor((sec%3600)/60),s=sec%60;return[h,m,s].map(v=>String(v).padStart(2,'0')).join(':')}
function startTableTimers(){
  document.querySelectorAll('.t-card[data-created]').forEach(card=>{
    const el=card.querySelector('.t-timer');if(!el)return;
    const start=new Date(card.dataset.created).getTime();
    function tick(){
      const e=Math.floor((Date.now()-start)/1000);
      el.textContent=fmtTimer(e);
      if(e>=3600&&card.classList.contains('running')){
        card.classList.replace('running','longwait');
        const b=card.querySelector('.t-badge');if(b)b.textContent='Long wait';
        card.dataset.status='longwait';
      }
    }
    tick();setInterval(tick,1000);
  });
}
document.addEventListener('DOMContentLoaded',startTableTimers);

/* ─── Filter chips ─── */
function filterTables(btn,status){
  document.querySelectorAll('.filter-scroll .chip').forEach(c=>c.classList.remove('active'));
  btn.classList.add('active');
  document.querySelectorAll('.t-card').forEach(card=>{
    card.style.display=(status==='all'||card.dataset.status===status)?'':'none';
  });
}

/* ─── Search tables ─── */
function searchTables(q){
  const query=q.toLowerCase().trim();
  document.querySelectorAll('.t-card').forEach(card=>{
    card.style.display=(!query||card.dataset.number.includes(query))?'':'none';
  });
}

/* ─── View toggle (grid/list) ─── */
function setView(type,btn){
  btn.parentElement.querySelectorAll('button').forEach(b=>b.style.background='transparent');
  btn.style.background='#fff';
  const grid=document.getElementById('tableGrid');
  if(type==='list'){
    grid.style.gridTemplateColumns='1fr';
    document.querySelectorAll('.t-card').forEach(c=>{
      c.style.flexDirection='row';c.style.minHeight='60px';c.style.alignItems='center';c.style.gap='1rem';
    });
  } else {
    grid.style.gridTemplateColumns='';
    document.querySelectorAll('.t-card').forEach(c=>{
      c.style.flexDirection='';c.style.minHeight='';c.style.alignItems='';c.style.gap='';
    });
  }
}

/* ─── Table pill selection in order panel ─── */
function selectTablePanel(btn,id,number){
  document.querySelectorAll('#tablePills .table-chip').forEach(c=>{
    c.classList.remove('active');
    const o=c.dataset.occupied=='1';
    c.style.background=o?'#dbeafe':'#e2dfff';
    c.querySelectorAll('span')[0].style.color=o?'#1e3a5f':'#3525cd';
    c.querySelectorAll('span')[1].style.color=o?'#3b82f6':'#4f46e5';
  });
  btn.classList.add('active');btn.style.background='';
  btn.querySelectorAll('span').forEach(s=>s.style.color='');
  document.querySelectorAll('.t-card').forEach(c=>c.classList.remove('table-active'));
  document.querySelector(`.t-card[data-id="${id}"]`)?.classList.add('table-active');
  document.getElementById('order_table_no').textContent=String(number).padStart(2,'0');
  getTableOrder(id);
}

/* ─── Table card clicks → load order panel ─── */
document.addEventListener('DOMContentLoaded',function(){
  document.querySelectorAll('.table-card').forEach(card=>{
    card.addEventListener('click',function(e){
      if(this.dataset.occupied=='0'||this.dataset.occupied=='')return;
      e.preventDefault();
      document.querySelectorAll('.table-card').forEach(c=>c.classList.remove('table-active'));
      this.classList.add('table-active');
      const id=this.dataset.id, number=this.dataset.number;
      document.getElementById('order_table_no').textContent=String(number).padStart(2,'0');
      // sync pill
      document.querySelectorAll('#tablePills .table-chip').forEach(c=>{
        c.classList.remove('active');
        const o=c.dataset.occupied=='1';
        c.style.background=o?'#dbeafe':'#e2dfff';
        c.querySelectorAll('span')[0].style.color=o?'#1e3a5f':'#3525cd';
        c.querySelectorAll('span')[1].style.color=o?'#3b82f6':'#4f46e5';
      });
      const p=document.querySelector(`#tablePills .table-chip[data-id="${id}"]`);
      if(p){p.classList.add('active');p.style.background='';}
      getTableOrder(id);
    });
  });
});

/* ─── Mobile panel toggle ─── */
function toggleMobilePanel(){
  const panel=document.querySelector('.right-panel');if(!panel)return;
  const showing=panel.style.display==='flex';
  panel.style.display=showing?'none':'flex';
  if(!showing){panel.style.position='fixed';panel.style.right='0';panel.style.top='0';panel.style.height='100%';panel.style.zIndex='100';panel.style.width='min(400px,100vw)';}
}

/* ─── Payment dropdown ─── */
document.getElementById('paymentTrigger')?.addEventListener('click',function(e){
  e.stopPropagation();
  document.getElementById('paymentMenu').classList.toggle('open');
  document.getElementById('paymentChevron').textContent=document.getElementById('paymentMenu').classList.contains('open')?'expand_less':'expand_more';
});
document.addEventListener('click',function(e){
  if(!e.target.closest('.payment-dropdown')){
    document.getElementById('paymentMenu')?.classList.remove('open');
    const c=document.getElementById('paymentChevron');if(c)c.textContent='expand_more';
  }
});

/* ─── Settlement modal ─── */
let _settleGrandTotal=0,_isPartPayment=false;

function openSettlementModal(){
  if(!window.currentOrderId){alert('Select an occupied table first.');return;}
  _settleGrandTotal=parseFloat((document.getElementById('grandTotal').textContent||'').replace(/[₹,]/g,''))||0;
  const tn=document.getElementById('order_table_no').textContent.trim();
  document.getElementById('settle-amount-label').textContent=(tn&&tn!=='—'?'— Table '+tn+' ':'')+' [₹'+_settleGrandTotal.toFixed(2)+']';
  document.getElementById('settle-paid').value='';
  document.getElementById('settle-return').value='0.00';
  document.getElementById('settle-tip').value='0';
  document.getElementById('settle-settlement').value='₹'+_settleGrandTotal.toFixed(2);
  _isPartPayment=false;
  document.querySelectorAll('#settlePills .settle-pay-pill').forEach((p,i)=>p.classList.toggle('pay-active',i===0));
  document.querySelector('#settlePills input[type="radio"]').checked=true;
  showStandardSection();
  document.getElementById('settlementModal').classList.add('open');
  setTimeout(()=>document.getElementById('settle-paid').focus(),150);
}
function closeSettlementModal(){document.getElementById('settlementModal').classList.remove('open')}
document.getElementById('settlementModal').addEventListener('click',function(e){if(e.target===this)closeSettlementModal()});

function onSettlePaymentChange(radio){
  document.querySelectorAll('#settlePills .settle-pay-pill').forEach(p=>p.classList.remove('pay-active'));
  radio.closest('.settle-pay-pill').classList.add('pay-active');
  _isPartPayment=radio.dataset.name.toLowerCase()==='part';
  _isPartPayment?showPartSection():showStandardSection();
}
function showStandardSection(){document.getElementById('standardPaySection').style.display='';document.getElementById('partPaymentSection').classList.remove('show');document.getElementById('partPaymentSection').style.display='none';recalcSettle(parseFloat(document.getElementById('settle-paid').value)||0,parseFloat(document.getElementById('settle-tip').value)||0)}
function showPartSection(){document.getElementById('standardPaySection').style.display='none';document.getElementById('partPaymentSection').classList.add('show');document.getElementById('partPaymentSection').style.display='block';buildPartRows()}
function buildPartRows(){
  const r=document.getElementById('partRows');r.innerHTML='';
  _paymentMethods.forEach(m=>{r.innerHTML+=`<div class="part-row"><span class="part-method-label">${m.name}</span><input type="number" class="part-input" data-method-id="${m.id}" data-method-name="${m.name}" placeholder="0" min="0" value="" oninput="onPartInput()"></div>`});
  updatePartRemaining();
}
function onPartInput(){updatePartRemaining()}
function updatePartRemaining(){
  let a=0;document.querySelectorAll('.part-input').forEach(i=>a+=parseFloat(i.value)||0);
  const r=_settleGrandTotal-a,el=document.getElementById('partRemaining');
  if(r<0){el.classList.remove('zero');el.style.color='#ef4444';el.textContent='−₹'+Math.abs(r).toFixed(2)+' (over)'}
  else if(r===0){el.classList.add('zero');el.style.color='';el.textContent='₹0.00'}
  else{el.classList.remove('zero');el.style.color='';el.textContent='₹'+r.toFixed(2)}
}
function onSettlePaidInput(v){recalcSettle(parseFloat(v)||0,parseFloat(document.getElementById('settle-tip').value)||0)}
function onSettleTipInput(v){recalcSettle(parseFloat(document.getElementById('settle-paid').value)||0,parseFloat(v)||0)}
function recalcSettle(paid,tip){
  document.getElementById('settle-return').value=Math.max(0,paid-_settleGrandTotal-tip).toFixed(2);
  document.getElementById('settle-settlement').value='₹'+(paid>0?Math.min(paid,_settleGrandTotal):_settleGrandTotal).toFixed(2);
}

function submitSettlement(){
  if(!window.currentOrderId){alert('No order loaded.');return;}
  const cn=document.getElementById('customer_name')?.value.trim()||'';
  const cp=document.getElementById('customer_phone')?.value.trim()||'';
  if(_isPartPayment){
    let a=0;document.querySelectorAll('.part-input').forEach(i=>a+=parseFloat(i.value)||0);
    if(a<=0){alert('Please enter payment amounts.');return;}
    if(a<_settleGrandTotal-0.01){alert('Total paid ₹'+a.toFixed(2)+' is less than bill ₹'+_settleGrandTotal.toFixed(2));return;}
  } else {
    const paid=parseFloat(document.getElementById('settle-paid').value)||0;
    if(paid<=0){alert('Customer paid amount must be greater than zero.');document.getElementById('settle-paid').focus();return;}
    if(paid<_settleGrandTotal-0.01){alert('Amount paid ₹'+paid.toFixed(2)+' is less than bill ₹'+_settleGrandTotal.toFixed(2));document.getElementById('settle-paid').focus();return;}
  }
  const sub=parseFloat((document.getElementById('subtotal').textContent||'').replace(/[₹,]/g,''))||0;
  let tax=0;document.querySelectorAll('input[name="tax_percentage[]"]').forEach(i=>tax+=parseFloat(i.getAttribute('data-computed-amount'))||0);
  let payload={order_id:window.currentOrderId,customer_name:cn,customer_phone:cp,subtotal:sub.toFixed(2),tax_total:tax.toFixed(2),discount:'0.00',grand_total:_settleGrandTotal.toFixed(2)};
  if(_isPartPayment){
    const parts=[];document.querySelectorAll('.part-input').forEach(i=>{const a=parseFloat(i.value)||0;if(a>0)parts.push({payment_method_id:i.dataset.methodId,payment_method:i.dataset.methodName,amount:a.toFixed(2)})});
    payload.is_part_payment=1;payload.part_payments=JSON.stringify(parts);payload.payment_method_id='part';payload.customer_paid=_settleGrandTotal.toFixed(2);payload.return_to_customer='0.00';payload.tip='0.00';
  } else {
    const paid=parseFloat(document.getElementById('settle-paid').value)||0;
    payload.is_part_payment=0;payload.payment_method_id=document.querySelector('input[name="settle_payment"]:checked').value;
    payload.customer_paid=paid.toFixed(2);payload.return_to_customer=(parseFloat(document.getElementById('settle-return').value)||0).toFixed(2);payload.tip=(parseFloat(document.getElementById('settle-tip').value)||0).toFixed(2);
  }
  const $btn=document.getElementById('settle-save-btn'),bu=document.getElementById('base_url').value;
  $btn.disabled=true;$btn.innerHTML='<span class="mi" style="font-size:16px;">progress_activity</span> Processing…';
  fetch(bu+'/orders/complete',{method:'POST',headers:{'Content-Type':'application/x-www-form-urlencoded','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content},body:new URLSearchParams(payload)})
  .then(r=>r.text()).then(html=>{
    closeSettlementModal();
    document.getElementById('silent-print-frame')?.remove();
    const iframe=document.createElement('iframe');iframe.id='silent-print-frame';
    iframe.style.cssText='position:fixed;top:-9999px;left:-9999px;width:302px;height:800px;border:none;visibility:hidden;';
    document.body.appendChild(iframe);
    const iDoc=iframe.contentDocument||iframe.contentWindow.document;iDoc.open();iDoc.write(html);iDoc.close();
    iframe.contentWindow.onload=function(){setTimeout(()=>{iframe.contentWindow.focus();iframe.contentWindow.onafterprint=()=>{iframe.remove();window.location.href='/orders'};iframe.contentWindow.print()},500)};
  }).catch(()=>{
    $btn.disabled=false;$btn.innerHTML='<span class="mi" style="font-size:16px;">check_circle</span> Settle &amp; Save';
    alert('Failed to complete order.');
  });
}
</script>
