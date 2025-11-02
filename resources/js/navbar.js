document.addEventListener("DOMContentLoaded", function () {
    // Elements
    const navbar = document.getElementById("navbar");
    const menuToggle = document.getElementById("menuToggle");
    const navLinks = document.getElementById("navLinks");

    // Scroll effect
    window.addEventListener("scroll", () => {
        navbar.classList.toggle("scrolled", window.scrollY > 10);
    });

    // Mobile toggle
    if (menuToggle && navLinks) {
        menuToggle.addEventListener("click", () => {
            navLinks.classList.toggle("show");
            menuToggle.innerHTML = navLinks.classList.contains("show")
                ? '<i class="bi bi-x-lg"></i>'
                : '<i class="bi bi-list"></i>';
        });
    }

    // Dropdown mobile
    document.querySelectorAll(".dropdown > .dropbtn").forEach((btn) => {
        btn.addEventListener("click", (e) => {
            if (window.innerWidth <= 900) {
                e.preventDefault();
                btn.parentElement.classList.toggle("open");
            }
        });
    });

    // Notification dropdown
    const notifBtn = document.querySelector(".notification-dropdown .dropbtn");
    if (notifBtn) {
        notifBtn.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            notifBtn.parentElement.classList.toggle("open");
        });
    }

    // Cart dropdown
    const cartBtn = document.querySelector(".cart-dropdown .dropbtn");
    if (cartBtn) {
        cartBtn.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            cartBtn.parentElement.classList.toggle("open");
            // Load cart items when opening dropdown
            if (cartBtn.parentElement.classList.contains("open")) {
                loadCartItems();
            }
        });
    }

    // User dropdown
    const userBtn = document.querySelector(".user-dropdown .dropbtn");
    if (userBtn) {
        userBtn.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            userBtn.parentElement.classList.toggle("open");
        });
    }

    // Close dropdowns when clicking outside
    document.addEventListener("click", (e) => {
        if (!e.target.closest(".dropdown")) {
            document.querySelectorAll(".dropdown.open").forEach((dropdown) => {
                dropdown.classList.remove("open");
            });
        }
    });

    // Prevent dropdown menu clicks from closing
    document.querySelectorAll(".dropdown-menu").forEach((menu) => {
        menu.addEventListener("click", (e) => {
            e.stopPropagation();
        });
    });

    // Initialize cart on page load
    updateCartBadge();

    // Listen for cart updates
    document.addEventListener("cartUpdated", function () {
        updateCartBadge();
    });
});

// Function to update cart badge
function updateCartBadge() {
    fetch("/keranjang/get", {
        method: "GET",
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
    })
        .then((response) => response.json())
        .then((data) => {
            const badge = document.getElementById("cartBadge");
            if (badge) {
                badge.textContent = data.total_items || 0;
            }
        })
        .catch((error) => {
            console.error("Error updating cart badge:", error);
            // Fallback: try to get from session storage for guest users
            try {
                const sessionCart = sessionStorage.getItem("keranjang");
                if (sessionCart) {
                    const cart = JSON.parse(sessionCart);
                    const total = Object.values(cart).reduce(
                        (sum, item) => sum + (item.jumlah || 0),
                        0
                    );
                    const badge = document.getElementById("cartBadge");
                    if (badge) {
                        badge.textContent = total;
                    }
                } else {
                    // No session cart, set to 0
                    const badge = document.getElementById("cartBadge");
                    if (badge) {
                        badge.textContent = "0";
                    }
                }
            } catch (e) {
                console.error("Fallback cart count failed:", e);
                // Set to 0 if all fails
                const badge = document.getElementById("cartBadge");
                if (badge) {
                    badge.textContent = "0";
                }
            }
        });
}

// Function to load cart items for dropdown
function loadCartItems() {
    fetch("/keranjang/get", {
        method: "GET",
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
    })
        .then((response) => response.json())
        .then((data) => {
            const cartMenu = document.getElementById("cartMenu");
            if (!cartMenu) return;

            if (data.items && data.items.length > 0) {
                let html = "";
                data.items.forEach((item) => {
                    html += `
                    <li class="cart-item d-flex align-items-center gap-2 p-2 border-bottom">
                        <img src="${
                            item.gambar
                                ? "/storage/" + item.gambar
                                : "/images/no-image.jpg"
                        }" alt="${item.nama}"
                            class="cart-img rounded" style="width:50px; height:50px; object-fit:cover;">
                        <div class="cart-info flex-grow-1">
                            <span class="cart-name fw-bold">${item.nama}</span>
                            ${
                                item.variasi
                                    ? `<span class="cart-variant d-block text-muted" style="font-size:0.8rem;">${item.variasi}</span>`
                                    : ""
                            }
                            <span class="cart-qty text-muted">x${
                                item.jumlah
                            }</span>
                            <span class="cart-price text-success fw-bold">Rp ${new Intl.NumberFormat(
                                "id-ID"
                            ).format(item.harga * item.jumlah)}</span>
                        </div>
                    </li>
                `;
                });
                html += `
                <li class="cart-footer d-flex justify-content-between p-2">
                    <a href="/keranjang" class="btn btn-outline-success btn-sm">Lihat Keranjang</a>
                    <a href="/checkout" class="btn btn-success btn-sm">Checkout</a>
                </li>
            `;
                cartMenu.innerHTML = html;
            } else {
                cartMenu.innerHTML =
                    '<li class="empty text-center p-2"><span>Keranjang kosong</span></li>';
            }
        })
        .catch((error) => {
            console.error("Error loading cart items:", error);
            // Fallback: try to get from session storage for guest users
            try {
                const sessionCart = sessionStorage.getItem("keranjang");
                if (sessionCart) {
                    const cart = JSON.parse(sessionCart);
                    const cartMenu = document.getElementById("cartMenu");
                    if (cartMenu) {
                        if (Object.keys(cart).length > 0) {
                            let html = "";
                            Object.values(cart).forEach((item) => {
                                html += `
                                <li class="cart-item d-flex align-items-center gap-2 p-2 border-bottom">
                                    <img src="${
                                        item.gambar
                                            ? "/storage/" + item.gambar
                                            : "/images/no-image.jpg"
                                    }" alt="${item.nama}"
                                        class="cart-img rounded" style="width:50px; height:50px; object-fit:cover;">
                                    <div class="cart-info flex-grow-1">
                                        <span class="cart-name fw-bold">${
                                            item.nama
                                        }</span>
                                        ${
                                            item.variasi
                                                ? `<span class="cart-variant d-block text-muted" style="font-size:0.8rem;">${item.variasi}</span>`
                                                : ""
                                        }
                                        <span class="cart-qty text-muted">x${
                                            item.jumlah || 1
                                        }</span>
                                        <span class="cart-price text-success fw-bold">Rp ${new Intl.NumberFormat(
                                            "id-ID"
                                        ).format(
                                            (item.harga || 0) *
                                                (item.jumlah || 1)
                                        )}</span>
                                    </div>
                                </li>
                            `;
                            });
                            html += `
                            <li class="cart-footer d-flex justify-content-between p-2">
                                <a href="/keranjang" class="btn btn-outline-success btn-sm">Lihat Keranjang</a>
                                <a href="/checkout" class="btn btn-success btn-sm">Checkout</a>
                            </li>
                        `;
                            cartMenu.innerHTML = html;
                        } else {
                            cartMenu.innerHTML =
                                '<li class="empty text-center p-2"><span>Keranjang kosong</span></li>';
                        }
                    }
                } else {
                    // No session cart
                    const cartMenu = document.getElementById("cartMenu");
                    if (cartMenu) {
                        cartMenu.innerHTML =
                            '<li class="empty text-center p-2"><span>Keranjang kosong</span></li>';
                    }
                }
            } catch (e) {
                console.error("Fallback cart loading failed:", e);
                // Set empty cart if all fails
                const cartMenu = document.getElementById("cartMenu");
                if (cartMenu) {
                    cartMenu.innerHTML =
                        '<li class="empty text-center p-2"><span>Keranjang kosong</span></li>';
                }
            }
        });
}
