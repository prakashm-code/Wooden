let currentOrderId = null;
let newItemCount = 0;

/* ══════════════════════════════════════════════════════
HELPER — global parcel charge field
══════════════════════════════════════════════════════ */
function getGlobalParcelCharge() {
    return parseFloat($(".parcel_charge").val()) || 0;
}

/* ══════════════════════════════════════════════════════
HELPER — total GST rate (sum of all tax_percentage[] inputs)
Used to show GST-inclusive price per row.
══════════════════════════════════════════════════════ */
function getTotalTaxRate() {
    let rate = 0;
    $("input[name='tax_percentage[]']").each(function () {
        rate += parseFloat($(this).val()) || 0;
    });
    return rate / 100;   // e.g. 0.18 for 18 %
}

/* ══════════════════════════════════════════════════════
HELPER — given a row <tr>, return { type, parcelPrice }
Works for BOTH buildRow (toggle-box) and buildRowView (row-toggle).
══════════════════════════════════════════════════════ */
function getRowToggleInfo(row) {
    // try .row-toggle first (view layout), then .toggle-box (order layout)
    let $activeBtn =
        row.find(".row-toggle button.active").add(
            row.find(".toggle-box button.active")).first();

    let type = $activeBtn.data("type") || "dine_in";

    // parcel price: button data-price → container data-parcel-price → global
    let parcelPrice =
        // parseFloat(row.find(".row-toggle button[data-type='parcel']").data("price")) ||
        // parseFloat(row.find(".toggle-box button[data-type='parcel']").data("price")) ||
        // parseFloat(row.find(".row-toggle").data("parcel-price")) ||
        getGlobalParcelCharge();

    console.log(type, parcelPrice);

    return { type, parcelPrice };
}

/* ══════════════════════════════════════════════════════
THALI CARD TOGGLE
══════════════════════════════════════════════════════ */
function toggleThaliCard(card) {
    let id = card.dataset.id;
    let name = card.dataset.name;
    let price = card.dataset.price;

    let existingRow = $(".order-row[data-thali-id='" + id + "'][data-new='1']");

    if (existingRow.length) {
        existingRow.fadeOut(150, function () {
            $(this).remove();
            newItemCount = Math.max(0, newItemCount - 1);
            updateRemoveBtns();
            finalCalculation();
            syncPlaceOrderBtn();
            if ($(".order-row").length === 0) {
                $("#order_items").html(
                    '<tr id="emptyRow"><td colspan="5" class="py-10 text-center text-sm text-slate-400">Select a thali above to add it to the order</td></tr>'
                );
            }
            if (newItemCount === 0) { $("#kotBtn").hide(); }
        });
        $(card).removeClass("thali-active");
        return;
    }

    $("#emptyRow").remove();
    let item = {
        thali_id: id,
        id: id,
        name: name,
        price: price,
        parcel_price: getGlobalParcelCharge(),
        order_type: "dine_in",
        quantity: 1,
        notes: ""
    };
    $("#order_items").append(buildRow(item, true));
    newItemCount++;

    $(card).addClass("thali-active");

    showKotBtn();
    finalCalculation();
    updateRemoveBtns();
    syncPlaceOrderBtn();
}

/* ══════════════════════════════════════════════════════
SYNC PLACE ORDER BUTTON
══════════════════════════════════════════════════════ */
function syncPlaceOrderBtn() {
    let $btn = $(".place-order-btn");
    let hasDiff = $(".order-row[data-new='0'][data-qty-diff]").length > 0;

    if (newItemCount > 0 || hasDiff) {
        $btn.prop("disabled", true)
            .attr("title", "Print KOT for new items first")
            .css({ "opacity": "0.5", "cursor": "not-allowed" });
    } else {
        $btn.prop("disabled", false)
            .attr("title", "")
            .css({ "opacity": "1", "cursor": "pointer" });
    }
}

/* ══════════════════════════════════════════════════════
CHECK EXISTING QTY DIFF
══════════════════════════════════════════════════════ */
function checkExistingQtyDiff() {
    let hasDiff = false;

    $(".order-row[data-new='0']").each(function () {
        let originalQty = parseInt($(this).attr("data-original-qty")) || 0;
        let currentQty = parseInt($(this).find(".qty-input").val()) || 0;
        let diff = currentQty - originalQty;

        if (diff > 0) {
            hasDiff = true;
            $(this).attr("data-qty-diff", diff);
        } else {
            $(this).removeAttr("data-qty-diff");
        }
    });

    if (hasDiff) {
        showKotBtn();
    } else if (newItemCount === 0) {
        $("#kotBtn").hide();
    }

    syncPlaceOrderBtn();
}

/* ══════════════════════════════════════════════════════
TOGGLE-BOX (take-order screen) — global type switch
══════════════════════════════════════════════════════ */
$(document).on("click", ".toggle-box button", function () {
    let box = $(this).closest(".toggle-box");
    box.find("button").each(function () {
        $(this)
            .removeClass("active bg-white shadow-sm text-primary dark:bg-slate-700")
            .addClass("text-slate-400");
    });
    $(this)
        .addClass("active bg-white shadow-sm text-primary dark:bg-slate-700")
        .removeClass("text-slate-400");
    box.data("selected", $(this).text().trim());
    finalCalculation();
});

/* ══════════════════════════════════════════════════════
FINAL CALCULATION
FIX 1 — parcel price now always resolved via getRowToggleInfo()
FIX 2 — price cells updated to show GST-inclusive unit price
══════════════════════════════════════════════════════ */
function finalCalculation() {
    let itemSubtotal = 0, totalQty = 0, parcelTotal = 0;
    let hasParcel = false;
    let taxRate = getTotalTaxRate();   // e.g. 0.18

    $(".order-row").each(function () {
        let $row = $(this);
        let price = parseFloat($row.find(".price").data("price")) || 0;
        let qty = parseInt($row.find(".qty-input").val()) || 0;
        let rowTotal = price * qty;

        // ── FIX 1: unified toggle reader ──────────────────
        let { type, parcelPrice } = getRowToggleInfo($row);

        // ── FIX 2: show GST-inclusive unit price ──────────
        let inclusivePrice = price * (1 + taxRate);
        $row.find(".price-text").text("₹" + inclusivePrice.toFixed(0));
        // also update row-total to include GST
        let inclusiveRowTotal = rowTotal * (1 + taxRate);

        // for parcel rows also add parcel charge
        let rowParcelAmt = 0;
        if (type === "parcel") {
            rowParcelAmt = parcelPrice * qty;
            parcelTotal += rowParcelAmt;
            hasParcel = true;
        }

        $row.find(".row-total").text((inclusiveRowTotal + rowParcelAmt).toFixed(0));

        itemSubtotal += rowTotal;
        totalQty += qty;
    });

    // ── Tax breakdown display ─────────────────────────────
    let totalTax = 0;
    $("input[name='tax_percentage[]']").each(function () {
        let percentage = parseFloat($(this).val()) || 0;
        let taxAmount = itemSubtotal * (percentage / 100);
        totalTax += taxAmount;

        $(this).attr("data-computed-amount", taxAmount.toFixed(2));

        let taxRow = $(this).closest(".total_payable");
        let displayEl = taxRow.find("span[id]");
        if (displayEl.length) displayEl.text(taxAmount.toFixed(2));
        let taxName = displayEl.attr("id");
        if (taxName) $("#" + taxName).text(taxAmount.toFixed(2));
    });

    let grand = itemSubtotal + parcelTotal + totalTax;
    console.log('grand', itemSubtotal);

    $("#subtotal").text(itemSubtotal);
    $("#parcelTotal").text(parcelTotal.toFixed(0));
    $("#grandTotal").text("₹" + grand.toFixed(0));
    $("#grand_Total").text(grand.toFixed(0));

    hasParcel ? $("#parcelRow").show() : $("#parcelRow").hide();

    let s = totalQty !== 1 ? "s" : "";
    $("#subtotal_label").text("Subtotal (" + totalQty + " item" + s + ")");
    $(".total_items").text(totalQty + " Items");
}

finalCalculation();

/* ══════════════════════════════════════════════════════
+ / − BUTTONS
══════════════════════════════════════════════════════ */
$(document).on("click", ".btn_plus", function () {
    let input = $(this).siblings(".qty-input");
    let val = parseInt(input.val()) || 0;
    input.val(val + 1);
    $(this).siblings(".qty-display").text(val + 1);
    finalCalculation();
    checkExistingQtyDiff();
});

$(document).on("click", ".btn_minus", function () {
    let input = $(this).siblings(".qty-input");
    let val = parseInt(input.val()) || 0;
    let row = $(this).closest(".order-row");
    let isExisting = row.data("new") == 0;
    let originalQty = parseInt(row.attr("data-original-qty")) || 0;
    let minQty = isExisting ? originalQty : 1;

    if (val > minQty) {
        input.val(val - 1);
        $(this).siblings(".qty-display").text(val - 1);
        finalCalculation();
        checkExistingQtyDiff();
    } else {
        let $btn = $(this);
        $btn.addClass("btn-at-min");
        setTimeout(() => $btn.removeClass("btn-at-min"), 400);
    }
});

/* ══════════════════════════════════════════════════════
PER-ROW TOGGLE
FIX: after switching, re-run finalCalculation so parcel
     price is immediately reflected in the row total.
══════════════════════════════════════════════════════ */
$(document).on("click", ".row-toggle button", function (e) {
    e.stopPropagation();
    let box = $(this).closest(".row-toggle");
    box.find("button").removeClass("active");
    $(this).addClass("active");

    let row = $(this).closest(".order-row");
    let type = $(this).data("type");

    if (type === "parcel") {
        if (!row.find(".tag-parcel").length)
            row.find(".item-name").append('<span class="tag-parcel">PARCEL</span>');
    } else {
        row.find(".tag-parcel").remove();
    }

    finalCalculation();   // ← recalculates this row's total with parcel charge
});

/* ══════════════════════════════════════════════════════
BUILD ROW (take-order screen — 5-column table)
FIX: stores parcelPrice on the parcel button as data-price
     so getRowToggleInfo() can always read it.
══════════════════════════════════════════════════════ */
function buildRow(item, isNew) {
    let price = parseFloat(item.price) || 0;
    let qty = isNew ? 1 : (parseInt(item.quantity) || 1);
    let parcelPrice = getGlobalParcelCharge();
    let orderType = item.order_type || "dine_in";
    let isParcel = orderType === "parcel";

    let thaliId = item.thali_id || item.id || '';
    let itemDbId = item.order_item_id || '';

    let newBadge = isNew ? '<span class="badge-new">NEW</span>' : '';
    let parcelTag = isParcel ? '<span class="tag-parcel">PARCEL</span>' : '';
    let newAttr = isNew ? 'data-new="1"' : 'data-new="0"';
    let originalQtyAttr = !isNew ? `data-original-qty="${qty}"` : `data-original-qty="1"`;
    let removeBtnStyle = isNew ? '' : 'style="display:none;"';

    let dineClass = !isParcel
        ? 'active px-3 py-1 text-[10px] font-bold rounded-md bg-white shadow-sm text-primary'
        : 'px-3 py-1 text-[10px] font-bold rounded-md text-slate-400';
    let parcelClass = isParcel
        ? 'active px-3 py-1 text-[10px] font-bold rounded-md bg-white shadow-sm text-primary'
        : 'px-3 py-1 text-[10px] font-bold rounded-md text-slate-400';

    // row-total will be recomputed by finalCalculation() after append
    return `
    <tr class="glass-card order-row"
        ${newAttr}
        ${originalQtyAttr}
        data-item-id="${itemDbId}"
        data-thali-id="${thaliId}">

        <td class="py-4 pl-4 rounded-l-xl">
            <input type="hidden" class="raw-menu_id" value="${thaliId}">
            <input type="hidden" class="raw_price"   value="${price}">
            <div class="flex items-center gap-4">
                <div>
                    <p class="item-title item-name">${item.name}${newBadge}${parcelTag}</p>
                    <p class="text-xs text-slate-400 mt-0.5">${item.notes || ''}</p>
                </div>
            </div>
        </td>

        <td class="price-text price py-4" data-price="${price}">
            ₹${price.toFixed(0)}
        </td>

        <td class="py-4">
            <div class="flex items-center qty gap-3">
                <button type="button"
                    class="qty-btn minus btn_minus size-8 rounded-lg border border-slate-200
                           flex items-center justify-center text-slate-500 hover:bg-slate-50">−</button>
                <input type="hidden" class="qty-input" value="${qty}">
                <span class="font-bold text-lg w-4 text-center qty-display">${qty}</span>
                <button type="button"
                    class="qty-btn plus btn_plus size-8 rounded-lg border border-slate-200
                           flex items-center justify-center text-slate-500 hover:bg-slate-50">+</button>
            </div>
        </td>

        <td class="py-4">
            <div class="flex p-1 bg-slate-100 rounded-lg w-fit toggle-box">
                <button type="button" class="${dineClass}"
                    data-type="dine_in" data-price="0">DINE IN</button>
                <button type="button" class="${parcelClass}"
                    data-type="parcel"  data-price="${parcelPrice}">PARCEL</button>
            </div>
        </td>

        <td class="py-4 pr-4 rounded-r-xl font-bold">
            <div class="flex items-center justify-between gap-2">
                <span class="row-total">₹${price.toFixed(0)}</span>
                <button type="button"
                    class="btn-remove-item size-6 rounded-full bg-slate-100 hover:bg-red-100
                           flex items-center justify-center text-slate-400 hover:text-red-500
                           transition-colors select-none flex-shrink-0"
                    data-item-id="${itemDbId}" title="Remove item" ${removeBtnStyle}>
                    <span class="material-symbols-outlined" style="font-size:13px;">close</span>
                </button>
            </div>
        </td>
    </tr>`;
}

/* ══════════════════════════════════════════════════════
BUILD ROW VIEW (view/edit screen — 3-column compact)
══════════════════════════════════════════════════════ */
function buildRowView(item, isNew) {
    let price = parseFloat(item.price) || 0;
    let qty = isNew ? 1 : (parseInt(item.quantity) || 1);
    let parcelPrice = parseFloat(item.parcel_price) || getGlobalParcelCharge();
    let orderType = item.order_type || "dine_in";
    let isParcel = orderType === "parcel";

    let thaliId = item.thali_id || item.id || '';
    let itemDbId = item.order_item_id || '';

    let newBadge = isNew ? '<span class="badge-new">NEW</span>' : '';
    let parcelTag = isParcel ? '<span class="tag-parcel">PARCEL</span>' : '';
    let newAttr = isNew ? 'data-new="1"' : 'data-new="0"';
    let originalQtyAttr = !isNew ? `data-original-qty="${qty}"` : `data-original-qty="1"`;
    let removeBtnStyle = isNew ? '' : 'style="display:none;"';

    let toggleDisabled = 'disabled';
    let toggleCursor = 'style="cursor:not-allowed; opacity:0.45;"';

    return `
    <tr class="order-row group hover:bg-slate-50 dark:hover:bg-zinc-800 transition-colors"
        ${newAttr}
        ${originalQtyAttr}
        data-item-id="${itemDbId}"
        data-thali-id="${thaliId}">

        <td class="py-3 pr-2">
            <input type="hidden" class="raw-menu_id" value="${thaliId}">
            <input type="hidden" class="raw_price"   value="${price}">
            <span  class="price" data-price="${price}" style="display:none;"></span>

            <p class="item-name text-sm font-bold text-slate-800 dark:text-white">
                ${item.name}${newBadge}${parcelTag}
            </p>
            <p class="text-xs text-slate-400 mt-0.5">${item.notes || ''}</p>

            <div class="row-toggle" data-parcel-price="${parcelPrice}">
                <button type="button" data-type="dine_in" data-price="0"
                    class="${!isParcel ? 'active' : ''}"
                    ${toggleDisabled} ${toggleCursor}>DINE IN</button>
                <button type="button" data-type="parcel"  data-price="${parcelPrice}"
                    class="${isParcel ? 'active' : ''}"
                    ${toggleDisabled} ${toggleCursor}>PARCEL</button>
            </div>
        </td>

        <td class="py-3">
            <div class="flex items-center justify-center gap-2">
                <button type="button"
                    class="btn_minus w-6 h-6 rounded border border-slate-200 flex items-center justify-center
                           text-slate-400 font-bold hover:text-primary hover:border-primary transition-colors select-none">−</button>
                <input  type="hidden" class="qty-input" value="${qty}">
                <span   class="qty-display text-sm font-bold w-5 text-center">${qty}</span>
                <button type="button"
                    class="btn_plus w-6 h-6 rounded border border-slate-200 flex items-center justify-center
                           text-slate-400 font-bold hover:text-primary hover:border-primary transition-colors select-none">+</button>
            </div>
        </td>

        <td class="py-3 text-right">
            <div class="flex items-center justify-end gap-2">
                <p class="row-total text-sm font-bold text-slate-800 dark:text-white">${price.toFixed(0)}</p>
                <button type="button"
                    class="btn-remove-item w-5 h-5 rounded-full bg-slate-100 hover:bg-red-100
                           flex items-center justify-center text-slate-400 hover:text-red-500
                           transition-colors select-none flex-shrink-0"
                    data-item-id="${itemDbId}" title="Remove item" ${removeBtnStyle}>
                    <span class="material-symbols-outlined" style="font-size:13px;">close</span>
                </button>
            </div>
        </td>
    </tr>`;
}

/* ══════════════════════════════════════════════════════
UPDATE REMOVE BUTTONS
══════════════════════════════════════════════════════ */
function updateRemoveBtns() {
    $(".order-row[data-new='0'] .btn-remove-item").hide();
    let newRows = $(".order-row[data-new='1']");
    if (newRows.length >= 1) newRows.find(".btn-remove-item").show();
}

/* ══════════════════════════════════════════════════════
REMOVE ITEM
══════════════════════════════════════════════════════ */
$(document).on("click", ".btn-remove-item", function () {
    let itemDbId = $(this).data("item-id");
    let row = $(this).closest(".order-row");
    let isNew = row.data("new") == 1;

    let thaliId = row.attr("data-thali-id");
    if (thaliId) {
        $(".thali-card-btn[data-id='" + thaliId + "']").removeClass("thali-active");
    }

    if (isNew || !itemDbId) {
        row.fadeOut(200, function () {
            $(this).remove();
            newItemCount = Math.max(0, newItemCount - 1);

            if (newItemCount === 0) {
                $("#kotBtn").hide();
                if ($(".order-row[data-new='0']").length > 0) {
                    $("#repeatOrderBtn").show();
                }
            }

            updateRemoveBtns();
            finalCalculation();
            syncPlaceOrderBtn();

            if ($(".order-row").length === 0) {
                $("#order_items").html(
                    '<tr id="emptyRow"><td colspan="5" class="py-10 text-center text-sm text-slate-400">Select a thali above to add it to the order</td></tr>'
                );
            }
        });
        return;
    }

    let $btn = $(this);
    let base_url = $("#base_url").val();
    $btn.prop("disabled", true)
        .html('<span class="material-symbols-outlined animate-spin" style="font-size:13px;">progress_activity</span>');

    $.ajax({
        url: base_url + "/order-items/" + itemDbId,
        method: "DELETE",
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
        success: function () {
            row.fadeOut(200, function () {
                $(this).remove();
                updateRemoveBtns();
                finalCalculation();
                syncPlaceOrderBtn();

                if ($(".order-row").length === 0) {
                    $("#order_items").html(
                        '<tr id="emptyRow"><td colspan="5" class="py-10 text-center text-sm text-slate-400">Select a thali above to add it to the order</td></tr>'
                    );
                }

                $(".order-row[data-new='0']").length > 0
                    ? $("#repeatOrderBtn").show()
                    : $("#repeatOrderBtn").hide();
            });
        },
        error: function (err) {
            console.error("Remove item error", err);
            $btn.prop("disabled", false)
                .html('<span class="material-symbols-outlined" style="font-size:13px;">close</span>');
            alert("Failed to remove item. Please try again.");
        }
    });
});

/* ══════════════════════════════════════════════════════
POPULATE ORDER PANEL
══════════════════════════════════════════════════════ */
// function populateOrderPanel(data) {
//     if (!data.status) return;

//     currentOrderId = data.order_id || null;
//     newItemCount   = 0;

//     $("#customer_name").val(data.customer_name  || "");
//     $("#customer_phone").val(data.customer_phone || "");

//     const tbody = $("#order_items");
//     tbody.empty();

//     if (!data.items || !data.items.length) {
//         tbody.html('<tr id="emptyRow"><td colspan="5" class="py-10 text-center text-sm text-slate-400">Select a thali above to add it to the order</td></tr>');
//         $("#repeatOrderBtn, #kotBtn").hide();
//         finalCalculation();
//         syncPlaceOrderBtn();
//         return;
//     }

//     $.each(data.items, function (i, item) {
//         if (!item.order_type) item.order_type = data.order_type || "dine_in";
//         tbody.append(buildRowView(item, false));
//     });

//     currentOrderId ? $("#repeatOrderBtn").show() : $("#repeatOrderBtn").hide();
//     $("#kotBtn").hide();
//     finalCalculation();
//     updateRemoveBtns();
//     syncPlaceOrderBtn();
// }
function populateOrderPanel(data) {
    if (!data.status) return;

    currentOrderId = data.order_id || null;
    newItemCount = 0;

    $("#customer_name").val(data.customer_name || "");
    $("#customer_phone").val(data.customer_phone || "");

    const $tbody = $("#order_items");
    $tbody.empty();

    if (!data.items || !data.items.length) {
        $tbody.html('<tr id="emptyRow"><td colspan="3" class="py-8 text-center text-sm text-slate-400">Select a table to load its order</td></tr>');
        $("#repeatOrderBtn, #kotBtn").hide();
        finalCalculation();
        syncPlaceOrderBtn();
        return;
    }

    // ── Merge duplicate thali rows by thali_id ──────────────
    const merged = {};
    data.items.forEach(function (item) {
        const key = item.thali_id || item.id;
        if (merged[key]) {
            // Already seen — add qty, keep first row's other data
            merged[key].quantity += parseInt(item.quantity) || 1;
            merged[key].total = merged[key].quantity * (parseFloat(item.price) || 0);
        } else {
            // First occurrence — clone so we don't mutate original
            merged[key] = Object.assign({}, item);
            merged[key].quantity = parseInt(item.quantity) || 1;
        }
    });

    $.each(Object.values(merged), function (_, item) {
        if (!item.order_type) item.order_type = data.order_type || "dine_in";
        $tbody.append(buildRowView(item, false));
    });

    currentOrderId ? $("#repeatOrderBtn").show() : $("#repeatOrderBtn").hide();
    $("#kotBtn").hide();
    finalCalculation();
    updateRemoveBtns();
    syncPlaceOrderBtn();
}
/* ══════════════════════════════════════════════════════
REPEAT ORDER
══════════════════════════════════════════════════════ */
$("#repeatOrderBtn").on("click", function () {
    $(".order-row[data-new='0']").each(function () {
        let existingType = $(this).find(".row-toggle button.active").data("type") || "dine_in";
        let repeatType = existingType === "parcel" ? "dine_in" : "parcel";

        let rowParcelPrice =
            parseFloat($(this).find(".row-toggle button[data-type='parcel']").data("price")) ||
            parseFloat($(this).find(".row-toggle").data("parcel-price")) ||
            getGlobalParcelCharge();

        let thaliId = $(this).find(".raw-menu_id").val()
            || $(this).attr("data-thali-id")
            || '';

        let item = {
            thali_id: thaliId,
            id: thaliId,
            name: $(this).find(".item-name").clone().children().remove().end().text().trim(),
            price: $(this).find(".raw_price").val(),
            parcel_price: rowParcelPrice,
            order_type: repeatType,
            quantity: 1,
            notes: $(this).find("p.text-xs").text().trim()
        };

        $("#order_items").append(buildRowView(item, true));
        newItemCount++;
    });

    $("#repeatOrderBtn").hide();
    showKotBtn();
    finalCalculation();
    updateRemoveBtns();
    syncPlaceOrderBtn();
});

/* ══════════════════════════════════════════════════════
ADD ITEM MODAL
══════════════════════════════════════════════════════ */
let menuCache = [];

$("#openAddItem").on("click", function () {
    $("#addItemModal").addClass("open");
    if (!menuCache.length) loadMenuItems();
});

$("#closeModal, #addItemModal").on("click", function (e) {
    if (e.target === this) {
        $("#addItemModal").removeClass("open");
        $("#menuSearch").val("");
        renderMenuList(menuCache);
    }
});

function loadMenuItems() {
    let base_url = $("#base_url").val();
    $.ajax({
        url: base_url + "/menu/items",
        type: "GET",
        success: function (res) {
            menuCache = res.items || res || [];
            renderMenuList(menuCache);
        },
        error: function () {
            $("#menuList").html('<p class="text-center text-sm text-red-400 py-8">Failed to load menu</p>');
        }
    });
}

function renderMenuList(items) {
    if (!items.length) {
        $("#menuList").html('<p class="text-center text-sm text-slate-400 py-8">No items found</p>');
        return;
    }
    $("#menuList").html(items.map(item => `
        <div class="menu-item-card"
            data-id="${item.id}"
            data-name="${item.name}"
            data-price="${item.price}"
            data-parcel="${item.parcel_price || 0}">
            <div>
                <p class="text-sm font-bold text-slate-800">${item.name}</p>
                <p class="text-xs text-slate-400">₹${parseFloat(item.price).toFixed(0)}</p>
            </div>
            <button class="add-btn" type="button">+</button>
        </div>
    `).join(""));
}

$("#menuSearch").on("input", function () {
    let q = $(this).val().toLowerCase();
    renderMenuList(menuCache.filter(i => i.name.toLowerCase().includes(q)));
});

$(document).on("click", ".menu-item-card .add-btn", function (e) {
    e.stopPropagation();
    let card = $(this).closest(".menu-item-card");
    addNewItemToOrder({
        id: card.data("id"),
        thali_id: card.data("id"),
        name: card.data("name"),
        price: card.data("price"),
        parcel_price: card.data("parcel") || getGlobalParcelCharge(),
        order_type: "dine_in",
        quantity: 1,
        notes: ""
    });
    let btn = $(this);
    btn.text("✓").css("background", "#16a34a");
    setTimeout(() => btn.text("+").css("background", "var(--primary)"), 900);
});

function addNewItemToOrder(item) {
    $("#emptyRow").remove();

    let existing = $(".order-row[data-new='1']").filter(function () {
        return $(this).attr("data-thali-id") == item.thali_id ||
            $(this).find(".raw-menu_id").val() == item.id;
    });

    if (existing.length) {
        let input = existing.find(".qty-input");
        let val = parseInt(input.val()) || 0;
        input.val(val + 1);
        existing.find(".qty-display").text(val + 1);
    } else {
        $("#order_items").append(buildRow(item, true));
        newItemCount++;
    }

    showKotBtn();
    finalCalculation();
    updateRemoveBtns();
    syncPlaceOrderBtn();
}

/* ══════════════════════════════════════════════════════
KOT
══════════════════════════════════════════════════════ */
function showKotBtn() {
    let total = newItemCount + $(".order-row[data-new='0'][data-qty-diff]").length;
    $("#kotBtn").show();
    $("#kotNewCount").text(total + " new");
}

$("#kotBtn").on("click", function () {
    if (!currentOrderId) {
        alert("No order loaded. Place the order first.");
        return;
    }

    let newItems = [];
    let newSubtotal = 0;

    $(".order-row").each(function () {
        let $row = $(this);
        let isNew = $row.data("new") == 1;
        let diff = parseInt($row.attr("data-qty-diff")) || 0;

        console.log('diff',diff);


        if (!isNew && diff <= 0) return;

        let price = parseFloat($row.find(".raw_price").val()) || 0;
        // let qty = isNew ? (parseInt($row.find(".qty-input").val()) || 0) : diff;
        // let total = price * qty;
        let thali_id = $row.find(".raw-menu_id").val() || $row.attr("data-thali-id") || null;
        let order_item_id = ($row.attr("data-item-id") && $row.attr("data-item-id") !== "")
            ? $row.attr("data-item-id") : null;

            console.log('isNew',isNew);
        let qty = (isNew && diff==0) ? (parseInt($row.find(".qty-input").val()) || 0) : diff;
        let total = price * qty;
        let { type, parcelPrice } = getRowToggleInfo($row);   // FIX: use unified reader
        newSubtotal += total;

        newItems.push({
            thali_id,
            order_item_id,
            quantity: qty,
            price,
            total,
            order_type: type,
            parcel_charge: type === "parcel" ? parcelPrice : 0
        });
    });

    if (!newItems.length) { alert("No new items to print."); return; }

    let $btn = $(this);
    let base_url = $("#base_url").val();
    $btn.prop("disabled", true).text("Printing...");

    $.ajax({
        url: base_url + "/orders/" + currentOrderId + "/add-kot",
        method: "POST",
        contentType: "application/json",
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
        data: JSON.stringify({ order_id: currentOrderId, subtotal: newSubtotal.toFixed(2), items: newItems }),
        xhrFields: { responseType: "text" },
        success: function (html) {
            $(".order-row[data-new='1']")
                .attr("data-new", "0")
                .find(".badge-new").remove();

             $(".order-row[data-new='0'][data-qty-diff]").each(function () {
                let currentQty = parseInt($(this).find(".qty-input").val()) || 0;
                $(this).attr("data-original-qty", currentQty);  // new baseline
                $(this).removeAttr("data-qty-diff");             // clear diff
            });

            newItemCount = 0;
            $("#kotBtn").hide();
            $("#repeatOrderBtn").show();
            updateRemoveBtns();
            syncPlaceOrderBtn();
            $("#silent-print-frame").remove();

            const iframe = document.createElement("iframe");
            iframe.id = "silent-print-frame";
            iframe.style.cssText =
                "position:fixed;top:-9999px;left:-9999px;" +
                "width:302px;height:800px;border:none;visibility:hidden;";
            document.body.appendChild(iframe);

            // Write HTML into iframe (onafterprint works on HTML iframes, not PDF)
            const iDoc = iframe.contentDocument || iframe.contentWindow.document;
            iDoc.open();
            iDoc.write(html);
            iDoc.close();

            iframe.contentWindow.onload = function () {
                setTimeout(function () {
                    iframe.contentWindow.focus();

                    // Fires when user closes dialog (print / save as PDF / cancel)
                    iframe.contentWindow.onafterprint = function () {
                        $("#silent-print-frame").remove();
                    };

                    iframe.contentWindow.print();
                }, 500);
            };
        },
        error: function (err) {
            console.error("KOT error", err);
            alert("Failed to print KOT. Please try again.");
        },
        complete: function () {
            $btn.prop("disabled", false)
                .html('<span class="material-symbols-outlined text-lg">receipt_long</span> Print KOT <span id="kotNewCount" class="bg-primary text-white text-xs font-bold px-2 py-0.5 rounded-full ml-1">0 new</span>');
        }
    });
});

/* ══════════════════════════════════════════════════════
PAYMENT DROPDOWN
══════════════════════════════════════════════════════ */
$("#paymentTrigger").on("click", function (e) {
    e.stopPropagation();
    $("#paymentMenu").toggleClass("open");
    $("#paymentChevron").text($("#paymentMenu").hasClass("open") ? "expand_less" : "expand_more");
});

$(document).on("click", ".payment-option", function () {
    let val = $(this).data("value");
    let icon = $(this).data("icon");
    let label = $(this).text().trim();
    $("#paymentIcon").text(icon);
    $("#paymentLabel").text(label);
    $("#payment_type").val(val);
    $(".payment-option").removeClass("selected");
    $(this).addClass("selected");
    $("#paymentMenu").removeClass("open");
    $("#paymentChevron").text("expand_more");
});

$(document).on("click", function (e) {
    if (!$(e.target).closest(".payment-dropdown").length) {
        $("#paymentMenu").removeClass("open");
        $("#paymentChevron").text("expand_more");
    }
});

/* ══════════════════════════════════════════════════════
COLLECT ORDER DATA
══════════════════════════════════════════════════════ */
function collectOrderData() {
    let items = [];
    $(".order-row").each(function () {
        let $row = $(this);
        let id = $row.find(".raw-menu_id").val() || $row.attr("data-thali-id") || '';
        let qty = parseInt($row.find(".qty-input").val()) || 0;
        let price = parseFloat($row.find(".raw_price").val()) || 0;
        let { type } = getRowToggleInfo($row);               // FIX: unified reader
        let is_new = $row.data("new") == 1 ? 1 : 0;
        let parcel_charge = type === "parcel"
            ? (parseFloat($row.find(".row-toggle button[data-type='parcel']").data("price")) ||
                parseFloat($row.find(".toggle-box button[data-type='parcel']").data("price")) ||
                getGlobalParcelCharge())
            : 0;

        if (qty > 0) items.push({
            thali_id: id,
            quantity: qty,
            price,
            total: price * qty,
            order_type: type,
            parcel_charge,
            is_new
        });
    });

    let taxes = [], taxIds = [], taxPercentages = [];
    $('input[name="tax_id[]"]').each(function (i) {
        let id = $(this).val();
        let percentage = $('input[name="tax_percentage[]"]').eq(i).val();
        let name = $('input[name="tax_name[]"]').eq(i).val() || "Tax";
        let subtotal = parseFloat($("#subtotal").text()) || 0;
        let amount = (subtotal * parseFloat(percentage) / 100).toFixed(2);
        taxes.push({ id, name, percentage, amount });
        taxIds.push(id);
        taxPercentages.push(percentage);
    });

    return { items, taxes, tax_ids: taxIds, tax_percentages: taxPercentages };
}

/* ══════════════════════════════════════════════════════
SAVE-PRINT
══════════════════════════════════════════════════════ */
// $(document).on("click", ".print-order-btn", function () {
//     let orderData = collectOrderData();
//     if (!orderData.items.length) { toastr.error("No items selected"); return; }

//     let base_url   = $("#base_url").val();
//     let activeType = $(".toggle-box button.active").data("type") || "dine_in";
//     let isParcel   = activeType === "parcel";

//     let data = {
//         table_id:      $(".table_id").val(),
//         table_number:  $(".table_number").val(),
//         items:         orderData,
//         subtotal:      $("#subtotal").text(),
//         parcel:        isParcel ? $("#parcelTotal").text() : 0,
//         parcel_charge: isParcel ? getGlobalParcelCharge()  : 0,
//         sgst:          $("#sgst").text(),
//         cgst:          $("#cgst").text(),
//         grand:         $("#grand_Total").text(),
//         order_type:    activeType,
//         is_parcel:     isParcel ? 1 : 0
//     };

//     let $btn = $(this);
//     $btn.prop("disabled", true)
//         .html('<span class="material-symbols-outlined animate-spin text-lg">progress_activity</span> Processing...');

//     $.ajax({
//         url:    base_url + "/orders/save-print",
//         method: "POST",
//         headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
//         data,
//         xhrFields: { responseType: "blob" },
//         success: function (blob) {
//             window.open(URL.createObjectURL(blob));
//             setTimeout(() => { window.location.href = "/orders"; }, 800);
//         },
//         error: function (err) {
//             console.error("Save-print error", err);
//             alert("Failed to place order. Please try again.");
//             $btn.prop("disabled", false)
//                 .html('<span class="material-symbols-outlined">send</span> Place Order to Kitchen');
//         }
//     });
// });

$(document).on("click", ".print-order-btn", function () {
    let orderData = collectOrderData();
    if (!orderData.items.length) { toastr.error("No items selected"); return; }

    let base_url = $("#base_url").val();
    let activeType = $(".toggle-box button.active").data("type") || "dine_in";
    let isParcel = activeType === "parcel";

    let data = {
        table_id: $(".table_id").val(),
        table_number: $(".table_number").val(),
        items: orderData,
        subtotal: $("#subtotal").text(),
        parcel: isParcel ? $("#parcelTotal").text() : 0,
        parcel_charge: isParcel ? getGlobalParcelCharge() : 0,
        sgst: $("#sgst").text(),
        cgst: $("#cgst").text(),
        grand: $("#grand_Total").text(),
        order_type: activeType,
        is_parcel: isParcel ? 1 : 0
    };

    let $btn = $(this);
    $btn.prop("disabled", true)
        .html('<span class="material-symbols-outlined animate-spin text-lg">progress_activity</span> Processing...');

    $.ajax({
        url: base_url + "/orders/save-print",
        method: "POST",
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
        data,
        xhrFields: { responseType: "text" },
        success: function (html) {
            console.log(html);


            // Remove old iframe if exists
            $("#silent-print-frame").remove();

            const iframe = document.createElement("iframe");
            iframe.id = "silent-print-frame";
            iframe.style.cssText =
                "position:fixed;top:-9999px;left:-9999px;" +
                "width:302px;height:800px;border:none;visibility:hidden;";
            document.body.appendChild(iframe);

            // Write HTML into iframe (onafterprint works on HTML iframes, not PDF)
            const iDoc = iframe.contentDocument || iframe.contentWindow.document;
            iDoc.open();
            iDoc.write(html);
            iDoc.close();

            iframe.contentWindow.onload = function () {
                setTimeout(function () {
                    iframe.contentWindow.focus();

                    // Fires when user closes dialog (print / save as PDF / cancel)
                    iframe.contentWindow.onafterprint = function () {
                        $("#silent-print-frame").remove();
                        window.location.href = "/orders";
                    };

                    iframe.contentWindow.print();
                }, 500);
            };
        },
        error: function (err) {
            console.error("Save-print error", err);
            alert("Failed to place order. Please try again.");
            $btn.prop("disabled", false)
                .html('<span class="material-symbols-outlined">send</span> Place Order to Kitchen');
        }
    });
});
/* ══════════════════════════════════════════════════════
PLACE & PROCESS ORDER
══════════════════════════════════════════════════════ */
$(document).on("click", ".place-order-btn", function () {
    if (!currentOrderId) {
        alert("No order loaded. Please select a table first.");
        return;
    }

    let customerName = $("#customer_name").val().trim();
    let customerPhone = $("#customer_phone").val().trim();

    // if (!customerName) {
    //     $("#customer_name").focus().addClass("border-red-400");
    //     toastr.error("Customer name is required.");
    //     return;
    // }
    // if (!customerPhone) {
    //     $("#customer_phone").focus().addClass("border-red-400");
    //     toastr.error("Customer phone is required.");
    //     return;
    // }

    $("#customer_name, #customer_phone").removeClass("border-red-400");

    let subtotal = parseFloat($("#subtotal").text()) || 0;
    let grandTotal = parseFloat($("#grandTotal").text().replace("₹", "")) || 0;
    let discount = 0;

    let taxBreakdown = [], taxTotal = 0;
    $("input[name='tax_percentage[]']").each(function (i) {
        let amount = parseFloat($(this).attr("data-computed-amount")) || 0;
        let id = $('input[name="tax_id[]"]').eq(i).val();
        taxTotal += amount;
        taxBreakdown.push({ tax_id: id, amount: amount.toFixed(2) });
    });

    let $btn = $(this);
    let base_url = $("#base_url").val();
    $btn.prop("disabled", true)
        .html('<span class="material-symbols-outlined animate-spin text-lg">progress_activity</span> Processing...');

    $.ajax({
        url: base_url + "/orders/complete",
        method: "POST",
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
        data: {
            order_id: currentOrderId,
            customer_name: customerName,
            customer_phone: customerPhone,
            payment_method_id: $("#payment_type").val(),
            subtotal: subtotal.toFixed(2),
            tax_total: taxTotal.toFixed(2),
            discount: discount.toFixed(2),
            grand_total: grandTotal.toFixed(2),
        },
        xhrFields: { responseType: "blob" },
        success: function (blob) {
            window.open(URL.createObjectURL(blob));
            setTimeout(() => { window.location.href = "/orders"; }, 800);
        },
        error: function (xhr) {
            let msg = "Failed to complete order.";
            try {
                let reader = new FileReader();
                reader.onload = function () {
                    try {
                        let json = JSON.parse(reader.result);
                        if (json.errors) msg = Object.values(json.errors).flat().join("\n");
                        else if (json.message) msg = json.message;
                    } catch (e) { }
                    alert(msg);
                };
                reader.readAsText(xhr.response);
            } catch (e) { alert(msg); }
            $btn.prop("disabled", false)
                .html('Place &amp; Process Order <span class="material-symbols-outlined">arrow_forward</span>');
        }
    });
});

/* ── Print Receipt ── */
$(document).on("click", ".print-receipt-btn", function () {
    if (!currentOrderId) { alert("No order loaded"); return; }
    window.open($("#base_url").val() + "/orders/" + currentOrderId + "/receipt");
});

/* ══════════════════════════════════════════════════════
GET TABLE ORDER + TABLE CARD CLICKS
══════════════════════════════════════════════════════ */
function getTableOrder(id) {
    let base_url = $("#base_url").val();
    $("#order_items").html('<tr><td colspan="5" class="py-8 text-center text-sm text-slate-400">Loading...</td></tr>');
    $("#repeatOrderBtn, #kotBtn").hide();

    $.ajax({
        url: base_url + "/table_orders/" + id,
        type: "GET",
        data: { _token: $("meta[name='csrf-token']").attr("content") },
        success: function (res) {
            console.log(res);

            populateOrderPanel(res);
        },
        error: function () {
            $("#order_items").html('<tr><td colspan="5" class="py-8 text-center text-sm text-red-400">Failed to load</td></tr>');
        }
    });
}

const tableCards = document.querySelectorAll(".table-card");
const aside = document.querySelector(".table-aside");
const section = document.querySelector(".table-section");

tableCards.forEach(card => {
    card.addEventListener("click", function () {
        if (this.dataset.occupied == "0" || this.dataset.occupied == "") return;

        const tableNumber = this.dataset.number;   // data-number="{{ $table->table_number }}"
        const isOpen = aside.classList.contains("aside-open");
        const activeId = aside.dataset.activeTable;

        if (isOpen && activeId === tableNumber) {
            aside.classList.remove("aside-open");
            section?.classList.remove("aside-open");
            aside.dataset.activeTable = "";
            tableCards.forEach(c => c.classList.remove("table-active"));
        } else {
            aside.classList.add("aside-open");
            section?.classList.add("aside-open");
            aside.dataset.activeTable = tableNumber;
            tableCards.forEach(c => c.classList.remove("table-active"));
            this.classList.add("table-active");
            aside.querySelector("h3").innerHTML =
                `Current Order – Table <span id="order_table_no">${tableNumber}</span>`;
            getTableOrder(this.dataset.id);
        }
    });
});

/* ══════════════════════════════════════════════════════
CUSTOMER SEARCH / AUTOCOMPLETE
══════════════════════════════════════════════════════ */
let searchTimeout = null;

function searchCustomer(type, query) {
    clearTimeout(searchTimeout);
    closeSuggestions();
    if (query.trim().length < 2) return;

    searchTimeout = setTimeout(() => {
        fetch(`/customers/search?type=${type}&query=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(customers => renderSuggestions(type, customers))
            .catch(() => closeSuggestions());
    }, 300);
}


function asideAddThali(card) {
    const id = card.dataset.id;
    const name = card.dataset.name;
    const price = parseFloat(card.dataset.price) || 0;
    const parcel = parseFloat(card.dataset.parcel) || 0;

    // ── Check if this thali already exists in ANY row (new or existing) ──
    const $existing = $(".order-row").filter(function () {
        return $(this).attr("data-thali-id") == id ||
            $(this).find(".raw-menu_id").val() == id;
    });

    if ($existing.length) {
        // Already in order — just bump qty
        const $input = $existing.find(".qty-input");
        const val = parseInt($input.val()) || 0;
        $input.val(val + 1);
        $existing.find(".qty-display").text(val + 1);

        // Brief highlight
        $existing.addClass("bg-primary/5");
        setTimeout(() => $existing.removeClass("bg-primary/5"), 600);

        checkExistingQtyDiff();
    } else {
        // Not in order — add a fresh row
        $("#emptyRow").remove();
        const item = {
            id: id,
            thali_id: id,
            name: name,
            price: price,
            parcel_price: parcel || getGlobalParcelCharge(),
            order_type: "dine_in",
            quantity: 1,
            notes: ""
        };
        $("#order_items").append(buildRowView(item, true));
        newItemCount++;
    }

    showKotBtn();
    finalCalculation();
    updateRemoveBtns();
    syncPlaceOrderBtn();

    $(card).addClass("strip-active");
}

function renderSuggestions(type, customers) {
    const box = document.getElementById(`suggestions_${type}`);
    box.innerHTML = "";

    if (!customers.length) { box.classList.add("hidden"); return; }

    customers.forEach(c => {
        const item = document.createElement("div");
        item.className = "px-3 py-2 text-sm cursor-pointer hover:bg-slate-100 dark:hover:bg-zinc-700 flex justify-between items-center";
        item.innerHTML = `
            <span class="font-medium text-slate-700 dark:text-slate-200">${c.name}</span>
            <span class="text-slate-400 text-xs">${c.phone}</span>
        `;
        item.onclick = () => selectCustomer(c);
        box.appendChild(item);
    });

    box.classList.remove("hidden");
}

function selectCustomer(customer) {
    document.getElementById("customer_name").value = customer.name;
    document.getElementById("customer_phone").value = customer.phone;
    closeSuggestions();
}

function closeSuggestions() {
    const nameBox = document.getElementById("suggestions_name");
    const phoneBox = document.getElementById("suggestions_phone");
    if (nameBox) nameBox.classList.add("hidden");
    if (phoneBox) phoneBox.classList.add("hidden");
}

document.addEventListener("click", function (e) {
    if (!e.target.closest("#customer_name") && !e.target.closest("#suggestions_name") &&
        !e.target.closest("#customer_phone") && !e.target.closest("#suggestions_phone")) {
        closeSuggestions();
    }
});
