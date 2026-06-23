{{--
════════════════════════════════════════════════════════
  ROYAL DINE POS  —  Atelier Design System
  Left  → Menu item cards
  Right → Order panel (3-zone: fixed top | scroll middle | fixed footer)
════════════════════════════════════════════════════════
--}}
@php
    $menu              = getThaliWithItems();
    $gstData           = gst_data();
    $getPaymentMethods = getPaymentMethod();
@endphp

<style>
/* ══════════════════════════════════════
   RESET & BASE
══════════════════════════════════════ */
*,*::before,*::after{box-sizing:border-box}
html,body{height:100%;margin:0;padding:0;}

.mi{
  font-family:'Material Symbols Outlined';font-weight:400;font-style:normal;font-size:1.25rem;
  line-height:1;letter-spacing:normal;text-transform:none;white-space:nowrap;direction:ltr;
  -webkit-font-smoothing:antialiased;
  font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;
  display:inline-flex;align-items:center;justify-content:center;vertical-align:middle;
}
.scrollable::-webkit-scrollbar{width:3px}
.scrollable::-webkit-scrollbar-track{background:transparent}
.scrollable::-webkit-scrollbar-thumb{background:rgba(79,70,229,.15);border-radius:8px}
.glass{background:rgba(255,255,255,.85);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);}

/* ══════════════════════════════════════
   TOP-LEVEL LAYOUT
   layout-root fills the FULL viewport
   minus whatever the outer shell takes
══════════════════════════════════════ */
.pos-wrap{
  display:flex;
  flex-direction:column;
  height:100%;          /* fill whatever the parent shell gives */
  overflow:hidden;
  background:#f7f9fb;
  color:#191c1e;
  font-family:'Inter',sans-serif;
}

/* ── header (flex-shrink:0 — never compresses) ── */
.pos-header{
  flex-shrink:0;
  background:rgba(255,255,255,.85);
  backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);
  padding:.75rem 1.5rem .75rem 1.5rem;
  display:flex;justify-content:space-between;align-items:center;
  border-bottom:1px solid rgba(79,70,229,.08);
  z-index:30;
}
.pos-search{
  background:#f2f4f6;border:none;border-radius:9999px;
  padding:.45rem 1rem .45rem 2.5rem;font-size:.83rem;
  color:#191c1e;width:16rem;outline:none;transition:background .15s;
}
.pos-search:focus{background:#eceef0}

/* ── body row (fills ALL remaining height) ── */
.pos-body{
  display:flex;
  flex:1;
  min-height:0;         /* ← critical: lets children shrink */
  overflow:hidden;
}

/* ══════════════════════════════════════
   LEFT PANEL — menu cards
══════════════════════════════════════ */
.left-panel{
  flex:1;
  min-width:0;
  display:flex;
  flex-direction:column;
  overflow:hidden;
}
/* sticky sub-header inside left */
.left-subhead{
  flex-shrink:0;
  padding:1rem 1.5rem .75rem;
  background:rgba(247,249,251,.92);
  backdrop-filter:blur(12px);
  border-bottom:1px solid #eceef0;
}
/* scrollable card area */
.left-scroll{
  flex:1;
  min-height:0;
  overflow-y:auto;
  padding:1rem 1.5rem 4rem;
}
.left-scroll::-webkit-scrollbar{width:3px}
.left-scroll::-webkit-scrollbar-thumb{background:rgba(79,70,229,.12);border-radius:8px}

/* filter chips */
.chip{
  padding:.4rem 1rem;border-radius:9999px;
  font-family:'Manrope',sans-serif;font-weight:700;font-size:.68rem;
  letter-spacing:.08em;text-transform:uppercase;
  cursor:pointer;border:none;white-space:nowrap;
  transition:background .15s,color .15s;
  background:#eceef0;color:#44474a;
}
.chip.active{background:linear-gradient(135deg,#3525cd,#4f46e5);color:#fff;box-shadow:0 4px 12px rgba(79,70,229,.20);}
.chip:not(.active):hover{background:#e2dfff;color:#3525cd}
.filter-row{display:flex;gap:.5rem;overflow-x:auto;scrollbar-width:none}
.filter-row::-webkit-scrollbar{display:none}

/* menu card grid */
.menu-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(200px,1fr));
  gap:1.125rem;
}
.menu-card{
  background:#fff;border-radius:1.5rem;
  box-shadow:0 4px 16px rgba(25,28,30,.04);
  transition:transform .22s,box-shadow .22s;
  padding:.875rem;
}
.menu-card:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(25,28,30,.09)}
.menu-card-img{
  position:relative;height:10rem;border-radius:1.125rem;
  overflow:hidden;margin-bottom:.75rem;background:#eceef0;
}
.menu-card-img img{width:100%;height:100%;object-fit:cover;transition:transform .4s}
.menu-card-img img:hover{transform:scale(1.06)}
.badge-veg{position:absolute;top:.5rem;right:.5rem;background:rgba(16,185,129,.12);color:#065f46;border-radius:9999px;font-size:.58rem;font-weight:800;letter-spacing:.06em;text-transform:uppercase;padding:2px 7px}
.badge-nonveg{position:absolute;top:.5rem;right:.5rem;background:rgba(239,68,68,.12);color:#991b1b;border-radius:9999px;font-size:.58rem;font-weight:800;letter-spacing:.06em;text-transform:uppercase;padding:2px 7px}
.img-placeholder{width:100%;height:100%;background:linear-gradient(135deg,#e2dfff,#c7c4f5);display:flex;align-items:center;justify-content:center}
.btn-add{
  width:100%;display:flex;align-items:center;justify-content:center;gap:.4rem;
  padding:.7rem;border-radius:1rem;background:#f2f4f6;
  color:#44474a;font-family:'Manrope',sans-serif;font-weight:700;font-size:.78rem;
  border:none;cursor:pointer;transition:background .15s,color .15s;
}
.btn-add:hover{background:linear-gradient(135deg,#3525cd,#4f46e5);color:#fff}

/* ══════════════════════════════════════
   RIGHT PANEL — 3-zone order panel
══════════════════════════════════════ */
.right-panel{
  width:390px;
  flex-shrink:0;
  display:flex;
  flex-direction:column;
  overflow:hidden;
  background:#f2f4f6;
  border-left:1px solid #eceef0;
}

/* ── Zone 1: fixed top ── */
.rp-top{
  flex-shrink:0;
  background:#f2f4f6;
}

/* ── Zone 2: scrollable cart — THE key zone ── */
.rp-middle{
  flex:1;
  min-height:0;         /* ← mandatory */
  overflow-y:auto;
  background:#f2f4f6;
  padding:0;
}
.rp-middle::-webkit-scrollbar{width:3px}
.rp-middle::-webkit-scrollbar-thumb{background:rgba(79,70,229,.12);border-radius:8px}

/* ── Zone 3: fixed footer ── */
.rp-footer{
  flex-shrink:0;
  background:#fff;
  padding:.875rem 1.25rem 1rem;
  box-shadow:0 -6px 20px rgba(25,28,30,.05);
  border-top:1px solid #eceef0;
}

/* order-type toggle */
.ot-wrap{display:flex;background:#eceef0;border-radius:1rem;padding:3px}
.ot-btn{
  flex:1;padding:.55rem .75rem;border-radius:.75rem;
  font-family:'Manrope',sans-serif;font-weight:700;font-size:.78rem;
  border:none;cursor:pointer;transition:background .15s,color .15s,box-shadow .15s;
  color:#44474a;background:transparent;
}
.ot-btn.active{background:#fff;color:#3525cd;box-shadow:0 2px 8px rgba(25,28,30,.06)}

/* table chips horizontal scroll */
.t-chips-wrap{
  display:flex;gap:.45rem;
  overflow-x:auto;
  padding:.6rem 1.125rem;
  scrollbar-width:none;
  border-bottom:1px solid #eceef0;
  background:#fff;
}
.t-chips-wrap::-webkit-scrollbar{display:none}
.t-chip{
  display:flex;flex-direction:column;align-items:center;justify-content:center;
  gap:1px;padding:.5rem .55rem;border-radius:.875rem;
  cursor:pointer;border:none;flex-shrink:0;min-width:54px;
  transition:background .15s,box-shadow .15s;
}
.t-chip.vacant{background:#e2dfff}
.t-chip.occupied{background:#dbeafe}
.t-chip.active{background:linear-gradient(135deg,#3525cd,#4f46e5);box-shadow:0 4px 14px rgba(79,70,229,.28)}
.t-chip.vacant:hover{background:#cbc8f5}
.t-chip.occupied:hover{background:#bfdbfe}
.t-chip-num{font-family:'Manrope',sans-serif;font-size:.95rem;font-weight:800;line-height:1}
.t-chip.vacant .t-chip-num,.t-chip.occupied+.t-chip-num{color:#3525cd}
.t-chip.occupied .t-chip-num{color:#1e3a5f}
.t-chip.active .t-chip-num{color:#fff}
.t-chip-lbl{font-size:.45rem;font-weight:800;letter-spacing:.09em;text-transform:uppercase}
.t-chip.vacant .t-chip-lbl{color:#4f46e5}
.t-chip.occupied .t-chip-lbl{color:#3b82f6}
.t-chip.active .t-chip-lbl{color:rgba(255,255,255,.75)}

/* cart col header row */
.cart-col-head{
  display:grid;
  grid-template-columns:1fr 4rem 5rem;
  padding:.4rem 1.125rem;
  font-size:.58rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:#94a3b8;
  border-bottom:1px solid #eceef0;
  background:#f2f4f6;
  position:sticky;top:0;z-index:2;
}

/* cart rows (pos.js renders these via buildRowView) */
.order-row{
  display:grid;
  grid-template-columns:1fr 4rem 5rem;
  align-items:center;
  padding:.65rem 1.125rem;
  border-bottom:1px solid #eceef0;
  background:#fff;
  transition:background .12s;
}
.order-row:last-child{border-bottom:none}
.order-row:hover{background:#fafbff}

/* keep pos.js class names working */
.item-name{font-size:.8rem;font-weight:700;color:#191c1e;line-height:1.3}
.badge-new{display:inline-block;font-size:8px;font-weight:800;letter-spacing:.06em;color:#fff;background:#4f46e5;border-radius:4px;padding:1px 5px;margin-left:4px;vertical-align:middle}
.tag-parcel{display:inline-block;font-size:8px;font-weight:700;background:#fef3c7;color:#92400e;border-radius:3px;padding:1px 5px;margin-left:4px;vertical-align:middle}
.row-toggle{display:inline-flex;background:#f1f5f9;border-radius:4px;padding:2px;gap:2px;margin-top:3px}
.row-toggle button{padding:1px 7px;font-size:8px;font-weight:800;border-radius:3px;border:none;cursor:pointer;color:#94a3b8;background:transparent;transition:all .12s}
.row-toggle button.active{background:#fff;color:#4f46e5;box-shadow:0 1px 3px rgba(0,0,0,.1)}
.price{display:none}/* hidden col — price shown via row-total */
.row-total{font-size:.82rem;font-weight:700;color:#191c1e;text-align:right}
.qty-display{font-size:.88rem;font-weight:700;text-align:center;min-width:1rem}
.btn_plus,.btn_minus{
  width:1.5rem;height:1.5rem;border-radius:50%;
  display:inline-flex;align-items:center;justify-content:center;
  border:none;cursor:pointer;font-weight:700;font-size:.95rem;transition:background .12s;
}
.btn_minus{background:#f2f4f6;color:#44474a}
.btn_minus:hover{background:#eceef0}
.btn_plus{background:linear-gradient(135deg,#3525cd,#4f46e5);color:#fff}
.btn_plus:hover{filter:brightness(1.1)}
.qty-btn{width:1.5rem;height:1.5rem;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;border:none;cursor:pointer;font-weight:700;font-size:.95rem;transition:background .12s;}
.qty-btn.minus{background:#f2f4f6;color:#44474a}.qty-btn.minus:hover{background:#eceef0}
.qty-btn.plus{background:linear-gradient(135deg,#3525cd,#4f46e5);color:#fff}.qty-btn.plus:hover{filter:brightness(1.1)}
.btn-remove-item{width:1.2rem;height:1.2rem;border-radius:50%;background:#f2f4f6;border:none;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;color:#94a3b8;transition:background .12s,color .12s;flex-shrink:0}
.btn-remove-item:hover{background:#fee2e2;color:#ef4444}
@keyframes shake{0%,100%{transform:translateX(0)}25%{transform:translateX(-3px)}75%{transform:translateX(3px)}}
.btn-at-min{animation:shake .3s ease;color:#ef4444!important}
.cart-row{background:#fff} /* alias */

/* empty state */
.cart-empty{padding:2.5rem 1rem;text-align:center;font-size:.83rem;color:#94a3b8}

/* summary rows */
.sum-row{display:flex;justify-content:space-between;align-items:center;font-size:.78rem;color:#44474a;margin-bottom:.35rem}
.sum-row .sv{font-weight:700;color:#191c1e}
.sum-total{display:flex;justify-content:space-between;align-items:center;padding-top:.55rem;margin-top:.3rem;border-top:1.5px dashed #eceef0}
.sum-total-label{font-family:'Manrope',sans-serif;font-weight:800;font-size:.95rem;color:#191c1e}
.sum-total-val{font-family:'Manrope',sans-serif;font-weight:800;font-size:1.3rem;color:#4f46e5}

/* buttons */
.btn-cta{
  width:100%;background:linear-gradient(135deg,#3525cd,#4f46e5);
  border-radius:1.25rem;color:#fff;
  font-family:'Manrope',sans-serif;font-weight:800;font-size:.93rem;
  letter-spacing:.02em;border:none;cursor:pointer;
  transition:filter .18s,transform .1s;
  display:flex;align-items:center;justify-content:center;gap:.4rem;
  padding:.85rem 1.25rem;
}
.btn-cta:hover{filter:brightness(1.08)}.btn-cta:active{transform:scale(.985)}.btn-cta:disabled{opacity:.5;cursor:not-allowed}
.btn-outline{
  padding:.65rem .75rem;border-radius:.875rem;background:#fff;color:#191c1e;
  font-family:'Manrope',sans-serif;font-weight:700;font-size:.68rem;
  letter-spacing:.06em;text-transform:uppercase;border:none;cursor:pointer;
  box-shadow:0 2px 8px rgba(25,28,30,.05);transition:background .14s,box-shadow .14s;
  display:flex;align-items:center;justify-content:center;gap:4px;
}
.btn-outline:hover{background:#f7f9fb;box-shadow:0 4px 12px rgba(25,28,30,.08)}
@keyframes kotPulse{0%,100%{box-shadow:0 0 0 0 rgba(79,70,229,.35)}50%{box-shadow:0 0 0 6px rgba(79,70,229,0)}}
#kotBtn{animation:kotPulse 1.8s infinite}

/* payment dropdown */
.payment-dropdown{position:relative}
.payment-dropdown-menu{display:none;position:absolute;bottom:calc(100% + 6px);left:0;width:100%;background:#fff;border:1px solid #e2e8f0;border-radius:.75rem;box-shadow:0 8px 24px rgba(0,0,0,.10);z-index:60;overflow:hidden}
.payment-dropdown-menu.open{display:block}
.payment-option{display:flex;align-items:center;gap:10px;padding:9px 13px;font-size:.8rem;font-weight:600;cursor:pointer;transition:background .12s;color:#334155}
.payment-option:hover{background:#f8fafc}
.payment-option.selected{color:#4f46e5;background:#e2dfff}

/* nav icons (sidenav hidden — handled by outer shell) */
.nav-icon{display:flex;align-items:center;justify-content:center;width:2.75rem;height:2.75rem;border-radius:1rem;cursor:pointer;transition:background .15s;color:#44474a;border:none;background:transparent}
.nav-icon.active{background:linear-gradient(135deg,#3525cd,#4f46e5);color:#fff;box-shadow:0 4px 16px rgba(79,70,229,.25)}
.nav-icon:not(.active):hover{background:#eceef0;color:#4f46e5}

/* suggestion autocomplete */
#suggestions_name,#suggestions_phone{position:absolute;z-index:50;width:100%;background:#fff;border:1px solid #e2e8f0;border-radius:.6rem;box-shadow:0 8px 24px rgba(0,0,0,.10);margin-top:3px;max-height:160px;overflow-y:auto;top:100%;left:0}

/* mobile FAB */
.mobile-fab{display:none;position:fixed;bottom:1.25rem;right:1.25rem;z-index:60}

/* ══════════════════════════════════════
   SETTLEMENT MODAL
══════════════════════════════════════ */
#settlementModal{display:none;position:fixed;inset:0;background:rgba(0,0,0,.55);z-index:200;align-items:center;justify-content:center;padding:1rem}
#settlementModal.open{display:flex}
.settle-box{background:#fff;border-radius:1rem;width:100%;max-width:520px;box-shadow:0 24px 60px rgba(0,0,0,.22);overflow:hidden;animation:sFadeIn .2s ease}
@keyframes sFadeIn{from{opacity:0;transform:scale(.96) translateY(8px)}to{opacity:1;transform:scale(1) translateY(0)}}
.settle-header{display:flex;align-items:center;justify-content:space-between;padding:16px 20px 12px;border-bottom:1px solid #f1f5f9}
.settle-title{font-size:16px;font-weight:700;color:#1e293b}
.settle-title span{color:#4f46e5;font-size:14px;font-weight:600;margin-left:6px}
.settle-close{width:28px;height:28px;border-radius:50%;border:none;background:#f1f5f9;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#64748b;transition:background .12s}
.settle-close:hover{background:#fee2e2;color:#ef4444}
.settle-body{padding:16px 20px}
.settle-pay-label{font-size:10px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#94a3b8;margin-bottom:8px;display:block}
.settle-pay-pills{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:16px}
.settle-pay-pill{display:flex;align-items:center;gap:6px;padding:5px 12px;border:1.5px solid #e2e8f0;border-radius:999px;cursor:pointer;font-size:12px;font-weight:600;color:#475569;background:#fff;transition:.12s;user-select:none}
.settle-pay-pill input[type="radio"]{width:12px;height:12px;accent-color:#4f46e5;cursor:pointer}
.settle-pay-pill.pay-active{border-color:#4f46e5;background:#e2dfff;color:#3525cd}
.settle-fields{display:flex;flex-direction:column;gap:10px}
.settle-row{display:flex;align-items:center;justify-content:space-between;gap:10px}
.settle-row label{font-size:13px;font-weight:600;color:#475569;min-width:140px;flex-shrink:0}
.settle-input{flex:1;padding:8px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:13px;font-weight:600;color:#1e293b;background:#f8fafc;outline:none;transition:border-color .12s}
.settle-input:focus{border-color:#4f46e5;background:#fff}
.settle-input.readonly-field{background:#f1f5f9;color:#64748b;cursor:default}
.settle-input.highlight-field{background:#fff;color:#4f46e5;font-size:15px;font-weight:800}
.settle-divider{border:none;border-top:1px dashed #e2e8f0;margin:3px 0 7px}
#partPaymentSection{display:none;margin-top:3px}
#partPaymentSection.show{display:block}
.part-section-label{font-size:10px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#94a3b8;margin-bottom:8px;display:block}
.part-rows{display:flex;flex-direction:column;gap:7px}
.part-row{display:flex;align-items:center;gap:7px}
.part-method-label{font-size:12px;font-weight:700;color:#475569;min-width:76px;flex-shrink:0}
.part-input{flex:1;padding:7px 11px;border:1.5px solid #e2e8f0;border-radius:7px;font-size:13px;font-weight:600;color:#1e293b;background:#f8fafc;outline:none;transition:border-color .12s}
.part-input:focus{border-color:#4f46e5;background:#fff}
.part-remaining-wrap{display:flex;align-items:center;justify-content:space-between;margin-top:9px;padding:7px 11px;background:#f8fafc;border-radius:7px;border:1px solid #e2e8f0}
.part-remaining-label{font-size:12px;font-weight:600;color:#64748b}
.part-remaining-val{font-size:13px;font-weight:800;color:#4f46e5}
.part-remaining-val.zero{color:#10b981}
.settle-footer{display:flex;align-items:center;justify-content:flex-end;gap:9px;padding:12px 20px 16px;border-top:1px solid #f1f5f9}
.settle-cancel-btn{padding:9px 20px;border-radius:8px;border:1.5px solid #e2e8f0;background:#fff;font-size:13px;font-weight:600;color:#64748b;cursor:pointer;transition:background .12s}
.settle-cancel-btn:hover{background:#f8fafc}
.settle-save-btn{padding:9px 24px;border-radius:8px;border:none;background:linear-gradient(135deg,#3525cd,#4f46e5);color:#fff;font-size:13px;font-weight:700;letter-spacing:.04em;cursor:pointer;display:flex;align-items:center;gap:6px;transition:filter .12s,transform .1s}
.settle-save-btn:hover{filter:brightness(1.08)}.settle-save-btn:active{transform:scale(.98)}.settle-save-btn:disabled{opacity:.55;cursor:not-allowed}

/* ══════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════ */
@media(max-width:900px){
  .right-panel{display:none!important}
  .mobile-fab{display:flex!important}
}
@media(max-width:640px){
  .pos-search-wrap{display:none}
  .left-scroll{padding:1rem 1rem 4rem}
  .menu-grid{grid-template-columns:repeat(auto-fill,minmax(160px,1fr))}
}
</style>

{{-- ══ SETTLEMENT MODAL ══ --}}
<div id="settlementModal">
  <div class="settle-box">
    <div class="settle-header">
      <p class="settle-title">Settle &amp; Save<span id="settle-amount-label"></span></p>
      <button class="settle-close" onclick="closeSettlementModal()"><span class="mi" style="font-size:15px">close</span></button>
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
          <div class="settle-row"><label>Settlement Amount</label><input type="text" id="settle-settlement" class="settle-input highlight-field" readonly></div>
        </div>
      </div>
      <div id="partPaymentSection">
        <span class="part-section-label">Split Payment by Method</span>
        <div class="part-rows" id="partRows"></div>
        <div class="part-remaining-wrap" style="margin-top:9px"><span class="part-remaining-label">Remaining</span><span class="part-remaining-val" id="partRemaining">₹0.00</span></div>
      </div>
    </div>
    <div class="settle-footer">
      <button class="settle-cancel-btn" onclick="closeSettlementModal()">Cancel</button>
      <button class="settle-save-btn" id="settle-save-btn" onclick="submitSettlement()">
        <span class="mi" style="font-size:15px">check_circle</span>Settle &amp; Save
      </button>
    </div>
  </div>
</div>

{{-- ══ POS WRAPPER ══ --}}
<div class="pos-wrap">



  {{-- Hidden pos.js inputs --}}
  <input type="hidden" id="parcel_charge"   value="{{ $parcel }}">
  <input type="hidden" class="parcel_charge" value="{{ $parcel }}">

  {{-- ── BODY ── --}}
  <div class="pos-body">

    {{-- ════ LEFT: MENU ITEMS ════ --}}
    <div class="left-panel">

      {{-- sticky sub-header --}}
      <div class="left-subhead">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:.75rem;">
          <h2 style="font-family:'Manrope',sans-serif;font-size:1.75rem;font-weight:800;letter-spacing:-.02em;color:#191c1e;margin:0;line-height:1.1;">Menu</h2>
          <div style="display:flex;gap:.35rem;background:#f2f4f6;border-radius:.7rem;padding:3px;">
            <button onclick="this.parentElement.querySelectorAll('button').forEach(b=>b.style.background='transparent');this.style.background='#fff';" style="background:#fff;border:none;border-radius:.5rem;padding:.35rem .55rem;cursor:pointer;">
              <span class="mi" style="color:#4f46e5;font-size:1rem;">grid_view</span>
            </button>
            <button onclick="this.parentElement.querySelectorAll('button').forEach(b=>b.style.background='transparent');this.style.background='#fff';" style="background:transparent;border:none;border-radius:.5rem;padding:.35rem .55rem;cursor:pointer;">
              <span class="mi" style="color:#44474a;font-size:1rem;">view_list</span>
            </button>
          </div>
        </div>
        <div class="filter-row">
          <button class="chip active" onclick="setChip(this);filterMenu('all')">All Items</button>
          @foreach($menu->unique('category')->whereNotNull('category') as $cat)
          <button class="chip" onclick="setChip(this);filterMenu('{{ $cat->category }}')">{{ $cat->category }}</button>
          @endforeach
        </div>
      </div>

      {{-- scrollable cards --}}
      <div class="left-scroll">
        <div class="menu-grid" id="menuGrid">
          @foreach($menu as $thali)
          <div class="menu-card" data-category="{{ $thali->category ?? 'all' }}" data-name="{{ strtolower($thali->name) }}">
            <div class="menu-card-img">
              @if(!empty($thali->image))
                <img src="{{ asset('storage/'.$thali->image) }}" alt="{{ $thali->name }}">
              @else
                <div class="img-placeholder">
                  <span class="mi" style="font-size:2.75rem;color:#4f46e5;opacity:.3;">restaurant_menu</span>
                </div>
              @endif
              @isset($thali->is_veg)
                <span class="{{ $thali->is_veg ? 'badge-veg' : 'badge-nonveg' }}">{{ $thali->is_veg ? 'VEG' : 'NON-VEG' }}</span>
              @endisset
            </div>
            <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:.4rem;margin-bottom:.65rem;">
              <div>
                <h3 style="font-family:'Manrope',sans-serif;font-weight:700;font-size:.9rem;color:#191c1e;line-height:1.25;margin:0 0 2px;">{{ $thali->name }}</h3>
                @if(!empty($thali->description))
                  <p style="font-size:.68rem;color:#44474a;margin:0;line-height:1.3;">{{ Str::limit($thali->description, 45) }}</p>
                @endif
              </div>
              <span style="font-family:'Manrope',sans-serif;font-weight:800;font-size:1.05rem;color:#4f46e5;white-space:nowrap;flex-shrink:0;">₹{{ number_format($thali->price,0) }}</span>
            </div>
            <button class="btn-add" onclick="addMenuItemToOrder(this,'{{ $thali->id }}','{{ addslashes($thali->name) }}',{{ $thali->price }},{{ $thali->parcel_price ?? 0 }})">
              <span class="mi" style="font-size:1rem;">add_circle</span> Add to Order
            </button>
          </div>
          @endforeach
        </div>
      </div>

    </div>{{-- /left-panel --}}

    {{-- ════ RIGHT: ORDER PANEL ════ --}}
    <aside class="right-panel">

      {{-- ── ZONE 1: TOP (never scrolls) ── --}}
      <div class="rp-top">

        {{-- Dine In / Parcel toggle --}}
        <div style="padding:.875rem 1.125rem .65rem;background:#fff;border-bottom:1px solid #eceef0;">
          <div class="ot-wrap toggle-box">
            <button class="ot-btn active" data-type="dine_in">Dine In</button>
            <button class="ot-btn" data-type="parcel">Parcel</button>
          </div>
        </div>

        {{-- Table chips — ALL tables horizontal scroll --}}
        <div class="t-chips-wrap" id="tablePills">
          @foreach($tables as $t)
          @php $occ = $t->occupied == 1; @endphp
          <button class="t-chip {{ $occ ? 'occupied' : 'vacant' }}"
            onclick="selectTablePanel(this,'{{ $t->id }}','{{ $t->table_number }}')"
            data-id="{{ $t->id }}" data-number="{{ $t->table_number }}" data-occupied="{{ $t->occupied }}">
            <span class="t-chip-num">T-{{ str_pad($t->table_number,2,'0',STR_PAD_LEFT) }}</span>
            <span class="t-chip-lbl">{{ $occ ? 'Active' : 'Open' }}</span>
          </button>
          @endforeach
        </div>

        {{-- Order header --}}
        <div style="padding:.55rem 1.125rem .5rem;display:flex;justify-content:space-between;align-items:center;background:#f2f4f6;">
          <span style="font-family:'Manrope',sans-serif;font-size:.95rem;font-weight:800;color:#191c1e;">Current Order</span>
          <span style="font-size:.68rem;color:#44474a;font-weight:600;">T-<span id="order_table_no">—</span></span>
        </div>

        {{-- Customer fields --}}
        @if(auth()->user()->role !== 'waiter')
        <div style="padding:.45rem 1.125rem .55rem;display:grid;grid-template-columns:1fr 1fr;gap:.45rem;background:#f2f4f6;border-bottom:1px solid #eceef0;">
          <div style="position:relative;">
            <input id="customer_name" type="text" placeholder="Customer name…" autocomplete="off" oninput="searchCustomer('name',this.value)"
              style="width:100%;background:#fff;border:none;border-radius:.65rem;padding:.42rem .65rem;font-size:.75rem;color:#191c1e;outline:none;box-shadow:0 2px 6px rgba(25,28,30,.04);">
            <div id="suggestions_name" class="hidden"></div>
          </div>
          <div style="position:relative;">
            <input id="customer_phone" type="text" placeholder="Mobile…" autocomplete="off" oninput="searchCustomer('phone',this.value)"
              style="width:100%;background:#fff;border:none;border-radius:.65rem;padding:.42rem .65rem;font-size:.75rem;color:#191c1e;outline:none;box-shadow:0 2px 6px rgba(25,28,30,.04);">
            <div id="suggestions_phone" class="hidden"></div>
          </div>
        </div>
        @endif

        {{-- Hidden thali data for pos.js --}}
        <div style="display:none" aria-hidden="true">
          @foreach($menu as $thali)
          <button class="thali-strip-btn"
            data-id="{{ $thali->id }}" data-name="{{ $thali->name }}"
            data-price="{{ $thali->price }}" data-parcel="{{ $thali->parcel_price ?? 0 }}"></button>
          @endforeach
        </div>

        {{-- Column headers (sticky inside rp-middle via position:sticky) --}}
        <div class="cart-col-head">
          <span>Item</span><span style="text-align:center">Qty</span><span style="text-align:right">Total</span>
        </div>

      </div>{{-- /rp-top --}}

      {{-- ── ZONE 2: SCROLLABLE CART ── --}}
      <div class="rp-middle" id="cartList">
        {{-- pos.js injects order-row elements here via buildRowView() --}}
        {{-- We use a table tbody so pos.js's TR-based rows render correctly --}}
        <table style="width:100%;border-collapse:collapse;">
          <tbody id="order_items">
            <tr id="emptyRow">
              <td colspan="3" class="cart-empty">Select a table to view its order</td>
            </tr>
          </tbody>
        </table>
      </div>

      {{-- ── ZONE 3: FOOTER (summary + actions) ── --}}
      <div class="rp-footer">

        {{-- Summary --}}
        <div style="margin-bottom:.65rem;">
          <div class="sum-row">
            <span id="subtotal_label">Subtotal</span>
            <span class="sv" id="subtotal">₹0</span>
          </div>
          @foreach($gstData as $gst)
          <div class="sum-row total_payable">
            <span>{{ $gst->name }} ({{ $gst->percentage }}%)</span>
            <span class="sv" id="{{ strtolower($gst->name) }}">₹0</span>
            <input type="hidden" name="tax_id[]"         value="{{ $gst->id }}">
            <input type="hidden" name="tax_percentage[]" value="{{ $gst->percentage }}">
          </div>
          @endforeach
          <div id="parcelRow" class="sum-row" style="display:none">
            <span>Parcel Charges</span><span class="sv" id="parcelTotal">₹0</span>
          </div>
          <div class="sum-total">
            <span class="sum-total-label">Total Due</span>
            <span class="sum-total-val" id="grandTotal">₹0</span>
          </div>
          <span id="grand_Total" style="display:none">0</span>
        </div>

        {{-- KOT / Repeat --}}
        <button id="repeatOrderBtn" style="display:none;width:100%;margin-bottom:.4rem;" class="btn-outline">
          <span class="mi" style="font-size:.85rem;margin-right:3px;">replay</span>Repeat Order
        </button>
        <button id="kotBtn" style="display:none;width:100%;margin-bottom:.5rem;" class="btn-outline">
          <span class="mi" style="font-size:.85rem;margin-right:3px;">receipt_long</span>Print KOT
          <span id="kotNewCount" style="background:#4f46e5;color:#fff;font-size:.6rem;font-weight:700;padding:1px 7px;border-radius:9999px;margin-left:4px;">0 new</span>
        </button>

        @if(auth()->user()->role !== 'waiter')
        {{-- Payment + Place Order 2-col --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:.5rem;margin-bottom:.55rem;">
          <div class="payment-dropdown">
            <div class="payment-dropdown-menu" id="paymentMenu">
              @foreach($getPaymentMethods as $m)
              <div class="payment-option {{ $loop->first ? 'selected' : '' }}" data-value="{{ $m->id }}" data-icon="payments">
                <span class="mi" style="font-size:.95rem;">payments</span>{{ $m->name }}
              </div>
              @endforeach
            </div>
            <div id="paymentTrigger" class="btn-outline" style="justify-content:flex-start;gap:.35rem;cursor:pointer;">
              <span class="mi" style="color:#4f46e5;font-size:.85rem;" id="paymentIcon">payments</span>
              <span id="paymentLabel" style="flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-size:.65rem;">{{ $getPaymentMethods->first()->name ?? 'Cash' }}</span>
              <span class="mi" style="color:#94a3b8;font-size:.85rem;" id="paymentChevron">expand_more</span>
            </div>
            <input type="hidden" id="payment_type" value="{{ $getPaymentMethods->first()->id ?? '' }}">
          </div>
          <button class="btn-outline" onclick="openSettlementModal()">
            <span class="mi" style="font-size:.85rem;margin-right:3px;">receipt_long</span>Place Order
          </button>
        </div>

        {{-- Primary CTA --}}
        <button class="btn-cta place-order-btn" onclick="openSettlementModal()">
          Proceed to Payment
          <span class="mi" style="font-size:1rem;">arrow_forward</span>
        </button>
        @endif

      </div>{{-- /rp-footer --}}

    </aside>{{-- /right-panel --}}

  </div>{{-- /pos-body --}}
</div>{{-- /pos-wrap --}}

{{-- Mobile FAB --}}
<div class="mobile-fab">
  <button class="btn-cta" style="padding:.8rem 1.4rem;font-size:.88rem;display:inline-flex;align-items:center;gap:.45rem;box-shadow:0 8px 24px rgba(53,37,205,.35);" onclick="toggleMobilePanel()">
    <span class="mi">shopping_bag</span>View Order
    <span id="mobileCartCount" style="background:rgba(255,255,255,.25);border-radius:9999px;padding:1px 8px;font-size:.68rem;">0</span>
  </button>
</div>

<script>
/* ── pos.js settlement variable ── */
const _paymentMethods = @json($getPaymentMethods->map(fn($m) => ['id' => $m->id, 'name' => $m->name]));

/* ── Filter chips ── */
function setChip(el){
  document.querySelectorAll('.filter-row .chip').forEach(c=>c.classList.remove('active'));
  el.classList.add('active');
}
function filterMenu(cat){
  document.querySelectorAll('#menuGrid .menu-card').forEach(card=>{
    card.style.display=(cat==='all'||card.dataset.category===cat)?'':'none';
  });
}
function searchMenuItems(q){
  const query=q.toLowerCase().trim();
  document.querySelectorAll('#menuGrid .menu-card').forEach(card=>{
    card.style.display=(!query||card.dataset.name.includes(query))?'':'none';
  });
}

/* ── Add menu item → pos.js ── */
function addMenuItemToOrder(btn,id,name,price,parcel){
  const fake=document.createElement('button');
  fake.dataset.id=id;fake.dataset.name=name;fake.dataset.price=price;fake.dataset.parcel=parcel||0;
  asideAddThali(fake);
  const mi=btn.querySelector('.mi');
  if(mi) mi.textContent='check_circle';
  btn.style.background='linear-gradient(135deg,#3525cd,#4f46e5)';btn.style.color='#fff';
  setTimeout(()=>{if(mi)mi.textContent='add_circle';btn.style.background='';btn.style.color='';},900);
}

/* ── Table chip selection ── */
function selectTablePanel(btn,id,number){
  document.querySelectorAll('#tablePills .t-chip').forEach(c=>c.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('order_table_no').textContent=String(number).padStart(2,'0');
  getTableOrder(id);
}

/* ── Mobile panel ── */
function toggleMobilePanel(){
  const p=document.querySelector('.right-panel');if(!p)return;
  const open=p.style.display==='flex';
  if(open){p.style.cssText=''}
  else{p.style.cssText='display:flex!important;position:fixed;right:0;top:0;height:100%;width:min(390px,100vw);z-index:100;flex-direction:column;overflow:hidden;background:#f2f4f6;border-left:1px solid #eceef0;'}
}

/* ── Payment dropdown ── */
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
document.addEventListener('click',function(e){
  if(e.target.classList.contains('payment-option')){
    const opt=e.target.closest('.payment-option');
    document.querySelectorAll('.payment-option').forEach(o=>o.classList.remove('selected'));
    opt.classList.add('selected');
    document.getElementById('paymentLabel').textContent=opt.textContent.trim();
    document.getElementById('payment_type').value=opt.dataset.value;
    document.getElementById('paymentMenu').classList.remove('open');
    document.getElementById('paymentChevron').textContent='expand_more';
  }
});

/* ── Settlement modal ── */
let _settleGrandTotal=0,_isPartPayment=false;

function openSettlementModal(){
  if(!window.currentOrderId){alert('Select an occupied table first.');return;}
  _settleGrandTotal=parseFloat((document.getElementById('grandTotal').textContent||'').replace(/[₹,]/g,''))||0;
  const tn=document.getElementById('order_table_no').textContent.trim();
  document.getElementById('settle-amount-label').textContent=(tn&&tn!=='—'?' — T-'+tn:'')+' [₹'+_settleGrandTotal.toFixed(2)+']';
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
function showStandardSection(){
  document.getElementById('standardPaySection').style.display='';
  document.getElementById('partPaymentSection').classList.remove('show');
  document.getElementById('partPaymentSection').style.display='none';
  recalcSettle(parseFloat(document.getElementById('settle-paid').value)||0,parseFloat(document.getElementById('settle-tip').value)||0);
}
function showPartSection(){
  document.getElementById('standardPaySection').style.display='none';
  document.getElementById('partPaymentSection').classList.add('show');
  document.getElementById('partPaymentSection').style.display='block';
  buildPartRows();
}
function buildPartRows(){
  const r=document.getElementById('partRows');r.innerHTML='';
  _paymentMethods.forEach(m=>{r.innerHTML+=`<div class="part-row"><span class="part-method-label">${m.name}</span><input type="number" class="part-input" data-method-id="${m.id}" data-method-name="${m.name}" placeholder="0" min="0" oninput="onPartInput()"></div>`});
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
  const cn=document.getElementById('customer_name')?.value.trim()||'',cp=document.getElementById('customer_phone')?.value.trim()||'';
  if(_isPartPayment){
    let a=0;document.querySelectorAll('.part-input').forEach(i=>a+=parseFloat(i.value)||0);
    if(a<=0){alert('Please enter payment amounts.');return;}
    if(a<_settleGrandTotal-0.01){alert('Total paid ₹'+a.toFixed(2)+' is less than bill ₹'+_settleGrandTotal.toFixed(2));return;}
  }else{
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
  }else{
    const paid=parseFloat(document.getElementById('settle-paid').value)||0;
    payload.is_part_payment=0;payload.payment_method_id=document.querySelector('input[name="settle_payment"]:checked').value;
    payload.customer_paid=paid.toFixed(2);payload.return_to_customer=(parseFloat(document.getElementById('settle-return').value)||0).toFixed(2);payload.tip=(parseFloat(document.getElementById('settle-tip').value)||0).toFixed(2);
  }
  const btn=document.getElementById('settle-save-btn'),bu=document.getElementById('base_url').value;
  btn.disabled=true;btn.innerHTML='<span class="mi" style="font-size:15px">progress_activity</span> Processing…';
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
    btn.disabled=false;btn.innerHTML='<span class="mi" style="font-size:15px">check_circle</span> Settle &amp; Save';
    alert('Failed to complete order.');
  });
}
</script>
