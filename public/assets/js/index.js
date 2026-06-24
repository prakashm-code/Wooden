// ========== NAVBAR SCROLL ==========
const navbar = document.getElementById("navbar");
window.addEventListener("scroll", () => {
    navbar.classList.toggle("scrolled", window.scrollY > 50);
});

// ========== SCROLL REVEAL ==========
const revealEls = document.querySelectorAll(".reveal");
const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add("visible");
                }, entry.target.dataset.delay || 0);
                observer.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.12 }
);

// Stagger cards
document.querySelectorAll(".product-card").forEach((card, i) => {
    card.dataset.delay = (i % 4) * 80;
});
document.querySelectorAll(".why-card").forEach((card, i) => {
    card.dataset.delay = i * 80;
});

revealEls.forEach((el) => observer.observe(el));
window.addEventListener("load", () => {
    setTimeout(() => {
        const loader = document.getElementById("pageLoader");
        if (loader) loader.classList.add("hidden");
    }, 1800);
});
// ========== ENQUIRY MODAL ==========
function openModal(productName) {
    document.getElementById("modalProductName").textContent = productName;
    document.getElementById("modalBackdrop").classList.add("active");
    document.getElementById("enquiryModal").classList.add("active");
    document.getElementById("modalSuccess").classList.remove("show");
    document.querySelector(".modal-submit").style.display = "block";
    document.querySelector(".modal-header").style.display = "block";
    document.querySelector(".modal-body").style.display = "grid";
    document.body.style.overflow = "hidden";
    // Pre-fill product in message
    document.getElementById(
        "enqMessage"
    ).value = `I am interested in: ${productName}`;
}

function closeModal() {
    document.getElementById("modalBackdrop").classList.remove("active");
    document.getElementById("enquiryModal").classList.remove("active");
    document.body.style.overflow = "";
    // Reset form
    setTimeout(() => {
        document.getElementById("enqName").value = "";
        document.getElementById("enqPhone").value = "";
        document.getElementById("enqEmail").value = "";
        document.getElementById("enqCity").value = "";
        document.getElementById("enqMessage").value = "";
    }, 350);
}

function submitEnquiry() {
    const name = document.getElementById("enqName").value.trim();
    const phone = document.getElementById("enqPhone").value.trim();

    if (!name) {
        shakeInput("enqName");
        return;
    }
    if (!phone) {
        shakeInput("enqPhone");
        return;
    }

    // Show loading
    const btn = document.querySelector(".modal-submit");
    btn.textContent = "Sending...";
    btn.disabled = true;

    setTimeout(() => {
        btn.style.display = "none";
        document.querySelector(".modal-header").style.display = "none";
        document.querySelector(".modal-body").style.display = "none";
        document.getElementById("modalSuccess").classList.add("show");

        // Auto close after 3s
        setTimeout(closeModal, 3000);
    }, 1200);
}

function shakeInput(id) {
    const el = document.getElementById(id);
    el.style.borderColor = "#c8102e";
    el.style.animation = "shake 0.4s ease";
    el.focus();
    setTimeout(() => {
        el.style.animation = "";
    }, 500);
}

// Escape key to close modal
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") closeModal();
});

// ========== SMOOTH ANCHOR SCROLL ==========
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", (e) => {
        const target = document.querySelector(anchor.getAttribute("href"));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: "smooth", block: "start" });
        }
    });
});

// ── About Us: counter animation + line trigger ──
const aboutStats = document.querySelectorAll(".stat-num");
let counted = false;

function countUp(el) {
    const target = +el.dataset.target;
    const duration = 1800;
    const step = target / (duration / 16);
    let current = 0;
    const timer = setInterval(() => {
        current += step;
        if (current >= target) {
            el.textContent = target.toLocaleString("en-IN");
            clearInterval(timer);
        } else {
            el.textContent = Math.floor(current).toLocaleString("en-IN");
        }
    }, 16);
}

// Trigger accent underline when title is visible
const aboutAccent = document.querySelector(".about-accent");

// Reuse your existing IntersectionObserver reveal logic, or add:
const aboutObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");

                // Counter
                if (
                    !counted &&
                    entry.target.classList.contains("about-stats")
                ) {
                    counted = true;
                    aboutStats.forEach((el) => countUp(el));
                }

                // Underline on accent
                if (aboutAccent) aboutAccent.classList.add("visible-underline");
            }
        });
    },
    { threshold: 0.2 }
);

document
    .querySelectorAll(".about-us .reveal, .about-us .reveal-line")
    .forEach((el) => {
        aboutObserver.observe(el);
    });
