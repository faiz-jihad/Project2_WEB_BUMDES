document.addEventListener("DOMContentLoaded", function () {
    // Elements
    const navbar = document.getElementById("navbar");
    const menuToggle = document.getElementById("menuToggle");
    const navLinks = document.getElementById("navLinks");

    // Scroll effect
    window.addEventListener("scroll", () => {
        if (navbar) {
            navbar.classList.toggle("scrolled", window.scrollY > 10);
        }
    });

    // Mobile menu toggle
    if (menuToggle && navLinks) {
        menuToggle.addEventListener("click", () => {
            navLinks.classList.toggle("show");
            menuToggle.innerHTML = navLinks.classList.contains("show")
                ? '<i class="bi bi-x-lg"></i>'
                : '<i class="bi bi-list"></i>';
        });
    }

    // Dropdown mobile interactions
    document.querySelectorAll(".dropdown > .dropbtn").forEach((btn) => {
        btn.addEventListener("click", (e) => {
            if (window.innerWidth <= 900) {
                e.preventDefault();
                const dropdown = btn.parentElement;
                const isOpen = dropdown.classList.contains("open");

                // Close all dropdowns first
                document.querySelectorAll(".dropdown.open").forEach((d) => {
                    if (d !== dropdown) d.classList.remove("open");
                });

                // Toggle current dropdown
                dropdown.classList.toggle("open");

                // Show/hide overlay
                const overlay = document.querySelector(".dropdown-overlay");
                if (overlay) {
                    overlay.classList.toggle("show", !isOpen);
                }
            }
        });
    });

    // Notification dropdown
    const notifBtn = document.querySelector(".notification-dropdown .dropbtn");
    if (notifBtn) {
        notifBtn.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            const dropdown = notifBtn.parentElement;
            const isOpen = dropdown.classList.contains("open");

            // Close other dropdowns
            document.querySelectorAll(".dropdown.open").forEach((d) => {
                if (d !== dropdown) d.classList.remove("open");
            });

            dropdown.classList.toggle("open");

            // Load notifications when opening
            if (!isOpen) {
                loadNotifications();
            }

            // Show/hide overlay on mobile
            if (window.innerWidth <= 900) {
                const overlay = document.querySelector(".dropdown-overlay");
                if (overlay) {
                    overlay.classList.toggle("show", !isOpen);
                }
            }
        });
    }

    // Cart dropdown
    const cartBtn = document.querySelector(".cart-dropdown .dropbtn");
    if (cartBtn) {
        cartBtn.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            const dropdown = cartBtn.parentElement;
            const isOpen = dropdown.classList.contains("open");

            // Close other dropdowns
            document.querySelectorAll(".dropdown.open").forEach((d) => {
                if (d !== dropdown) d.classList.remove("open");
            });

            dropdown.classList.toggle("open");

            // Load cart items when opening dropdown
            if (!isOpen) {
                loadCartItems();
            }

            // Show/hide overlay on mobile
            if (window.innerWidth <= 900) {
                const overlay = document.querySelector(".dropdown-overlay");
                if (overlay) {
                    overlay.classList.toggle("show", !isOpen);
                }
            }
        });
    }

    // User dropdown
    const userBtn = document.querySelector(".user-dropdown .dropbtn");
    if (userBtn) {
        userBtn.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            const dropdown = userBtn.parentElement;
            const isOpen = dropdown.classList.contains("open");

            // Close other dropdowns
            document.querySelectorAll(".dropdown.open").forEach((d) => {
                if (d !== dropdown) d.classList.remove("open");
            });

            dropdown.classList.toggle("open");

            // Show/hide overlay on mobile
            if (window.innerWidth <= 900) {
                const overlay = document.querySelector(".dropdown-overlay");
                if (overlay) {
                    overlay.classList.toggle("show", !isOpen);
                }
            }
        });
    }

    // Close dropdowns when clicking outside or on overlay
    document.addEventListener("click", (e) => {
        if (
            !e.target.closest(".dropdown") ||
            e.target.classList.contains("dropdown-overlay")
        ) {
            document.querySelectorAll(".dropdown.open").forEach((dropdown) => {
                dropdown.classList.remove("open");
            });
            const overlay = document.querySelector(".dropdown-overlay");
            if (overlay) {
                overlay.classList.remove("show");
            }
        }
    });

    // Prevent dropdown menu clicks from closing
    document
        .querySelectorAll(".dropdown-menu, .notif-menu, .cart-menu, .user-menu")
        .forEach((menu) => {
            menu.addEventListener("click", (e) => {
                e.stopPropagation();
            });
        });

    // Initialize on page load
    updateCartBadge();
    updateNotificationBadge();

    // Listen for cart updates
    document.addEventListener("cartUpdated", function () {
        updateCartBadge();
    });

    // Listen for notification updates
    document.addEventListener("notificationUpdated", function () {
        updateNotificationBadge();
    });

    // Auto-refresh notifications every 30 seconds
    setInterval(() => {
        updateNotificationBadge();
    }, 30000);
});

// Function to update cart badge
function updateCartBadge() {
    fetch("/keranjang/get", {
        method: "GET",
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                ?.content,
        },
    })
        .then((response) => response.json())
        .then((data) => {
            const badge = document.getElementById("cartBadge");
            if (badge) {
                const count = data.total_items || 0;
                badge.textContent = count;
                badge.style.display = count > 0 ? "flex" : "none";
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
                        badge.style.display = total > 0 ? "flex" : "none";
                    }
                } else {
                    const badge = document.getElementById("cartBadge");
                    if (badge) {
                        badge.textContent = "0";
                        badge.style.display = "none";
                    }
                }
            } catch (e) {
                console.error("Fallback cart count failed:", e);
                const badge = document.getElementById("cartBadge");
                if (badge) {
                    badge.textContent = "0";
                    badge.style.display = "none";
                }
            }
        });
}

// Function to update notification badge
function updateNotificationBadge() {
    fetch("/notifikasi/count", {
        method: "GET",
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                ?.content,
        },
    })
        .then((response) => response.json())
        .then((data) => {
            const badge = document.getElementById("notifBadge");
            if (badge) {
                const count = data.unread_count || 0;
                badge.textContent = count;
                badge.style.display = count > 0 ? "flex" : "none";
            }
        })
        .catch((error) => {
            console.error("Error updating notification badge:", error);
            const badge = document.getElementById("notifBadge");
            if (badge) {
                badge.textContent = "0";
                badge.style.display = "none";
            }
        });
}

// Function to load notifications
function loadNotifications() {
    fetch("/notifikasi/get", {
        method: "GET",
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                ?.content,
        },
    })
        .then((response) => response.json())
        .then((data) => {
            const notifMenu = document.getElementById("notifMenu");
            if (!notifMenu) return;

            if (data.notifications && data.notifications.length > 0) {
                let html = "";
                data.notifications.slice(0, 5).forEach((notif) => {
                    const isUnread = !notif.read_at;
                    html += `
                        <li class="notif-item ${
                            isUnread ? "unread" : ""
                        }" data-id="${notif.id}">
                            <a href="${
                                notif.data?.url || "#"
                            }" class="d-block p-3" onclick="markAsRead(${
                        notif.id
                    })">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="flex-grow-1">
                                        <div class="fw-bold mb-1">${
                                            notif.data?.title || "Notifikasi"
                                        }</div>
                                        <div class="text-muted small">${
                                            notif.data?.message ||
                                            notif.data?.body ||
                                            ""
                                        }</div>
                                        <div class="text-muted small mt-1">${formatTimeAgo(
                                            notif.created_at
                                        )}</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    `;
                });

                if (data.notifications.length > 5) {
                    html += `
                        <li class="notif-item">
                            <a href="/notifikasi" class="view-all-btn d-block text-center p-2">
                                Lihat Semua Notifikasi
                            </a>
                        </li>
                    `;
                }

                notifMenu.innerHTML = html;
            } else {
                notifMenu.innerHTML = `
                    <li class="notif-item">
                        <div class="empty text-center p-3">
                            <i class="bi bi-bell-slash text-muted mb-2" style="font-size: 2rem;"></i>
                            <div>Tidak ada notifikasi</div>
                        </div>
                    </li>
                `;
            }
        })
        .catch((error) => {
            console.error("Error loading notifications:", error);
            const notifMenu = document.getElementById("notifMenu");
            if (notifMenu) {
                notifMenu.innerHTML = `
                    <li class="notif-item">
                        <div class="empty text-center p-3 text-danger">
                            Gagal memuat notifikasi
                        </div>
                    </li>
                `;
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
                ?.content,
        },
    })
        .then((response) => response.json())
        .then((data) => {
            const cartMenu = document.getElementById("cartMenu");
            if (!cartMenu) return;

            if (data.items && data.items.length > 0) {
                let html = "";
                let total = 0;

                data.items.forEach((item) => {
                    const itemTotal = item.harga * item.jumlah;
                    total += itemTotal;
                    html += `
                        <div class="cart-item">
                            <img src="${
                                item.gambar
                                    ? "/storage/" + item.gambar
                                    : "/images/no-image.jpg"
                            }"
                                 alt="${item.nama}" class="cart-img">
                            <div class="cart-info">
                                <div class="cart-name">${item.nama}</div>
                                ${
                                    item.variasi
                                        ? `<div class="cart-qty">${item.variasi}</div>`
                                        : ""
                                }
                                <div class="cart-qty">Qty: ${item.jumlah}</div>
                                <div class="cart-price">Rp ${new Intl.NumberFormat(
                                    "id-ID"
                                ).format(itemTotal)}</div>
                            </div>
                        </div>
                    `;
                });

                html += `
                    <div class="cart-footer">
                        <div class="cart-total fw-bold">Total: Rp ${new Intl.NumberFormat(
                            "id-ID"
                        ).format(total)}</div>
                        <div class="d-flex gap-2">
                            <a href="/keranjang" class="btn-cart">Lihat Keranjang</a>
                            <a href="/checkout" class="btn-checkout">Checkout</a>
                        </div>
                    </div>
                `;

                cartMenu.innerHTML = html;
            } else {
                cartMenu.innerHTML =
                    '<div class="empty">Keranjang kosong</div>';
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
                            let total = 0;

                            Object.values(cart).forEach((item) => {
                                const itemTotal =
                                    (item.harga || 0) * (item.jumlah || 1);
                                total += itemTotal;
                                html += `
                                    <div class="cart-item">
                                        <img src="${
                                            item.gambar
                                                ? "/storage/" + item.gambar
                                                : "/images/no-image.jpg"
                                        }"
                                             alt="${
                                                 item.nama
                                             }" class="cart-img">
                                        <div class="cart-info">
                                            <div class="cart-name">${
                                                item.nama
                                            }</div>
                                            ${
                                                item.variasi
                                                    ? `<div class="cart-qty">${item.variasi}</div>`
                                                    : ""
                                            }
                                            <div class="cart-qty">Qty: ${
                                                item.jumlah || 1
                                            }</div>
                                            <div class="cart-price">Rp ${new Intl.NumberFormat(
                                                "id-ID"
                                            ).format(itemTotal)}</div>
                                        </div>
                                    </div>
                                `;
                            });

                            html += `
                                <div class="cart-footer">
                                    <div class="cart-total fw-bold">Total: Rp ${new Intl.NumberFormat(
                                        "id-ID"
                                    ).format(total)}</div>
                                    <div class="d-flex gap-2">
                                        <a href="/keranjang" class="btn-cart">Lihat Keranjang</a>
                                        <a href="/checkout" class="btn-checkout">Checkout</a>
                                    </div>
                                </div>
                            `;

                            cartMenu.innerHTML = html;
                        } else {
                            cartMenu.innerHTML =
                                '<div class="empty">Keranjang kosong</div>';
                        }
                    }
                } else {
                    const cartMenu = document.getElementById("cartMenu");
                    if (cartMenu) {
                        cartMenu.innerHTML =
                            '<div class="empty">Keranjang kosong</div>';
                    }
                }
            } catch (e) {
                console.error("Fallback cart loading failed:", e);
                const cartMenu = document.getElementById("cartMenu");
                if (cartMenu) {
                    cartMenu.innerHTML =
                        '<div class="empty">Keranjang kosong</div>';
                }
            }
        });
}

// Function to mark notification as read
function markAsRead(notificationId) {
    fetch(`/notifikasi/${notificationId}/read`, {
        method: "POST",
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                ?.content,
        },
    })
        .then(() => {
            updateNotificationBadge();
        })
        .catch((error) => {
            console.error("Error marking notification as read:", error);
        });
}

// Function to format time ago
function formatTimeAgo(dateString) {
    const now = new Date();
    const date = new Date(dateString);
    const diffInSeconds = Math.floor((now - date) / 1000);

    if (diffInSeconds < 60) return "Baru saja";
    if (diffInSeconds < 3600)
        return `${Math.floor(diffInSeconds / 60)} menit yang lalu`;
    if (diffInSeconds < 86400)
        return `${Math.floor(diffInSeconds / 3600)} jam yang lalu`;
    if (diffInSeconds < 604800)
        return `${Math.floor(diffInSeconds / 86400)} hari yang lalu`;

    return date.toLocaleDateString("id-ID", {
        day: "numeric",
        month: "short",
        year: date.getFullYear() !== now.getFullYear() ? "numeric" : undefined,
    });
}
