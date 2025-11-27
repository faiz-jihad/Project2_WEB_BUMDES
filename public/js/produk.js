document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll(".product-card");
    const searchInput = document.getElementById("productSearch");
    const productsGrid = document.getElementById("productsGrid");

    const categoryButtons = document.querySelectorAll(".category-pill");

    const filterToggleBtn = document.getElementById("filterToggleBtn");
    const filterSidebar = document.getElementById("filterSidebar");
    const filterOverlay = document.getElementById("filterOverlay");
    const closeFilter = document.getElementById("closeFilter");

    const minPrice = document.getElementById("minPrice");
    const maxPrice = document.getElementById("maxPrice");

    const stockCheckboxes = document.querySelectorAll(
        ".stock-status-options input[type=checkbox]"
    );

    // Sort functionality
    const sortBtn = document.getElementById("sortBtn");
    const sortMenu = document.getElementById("sortMenu");
    const sortOptions = document.querySelectorAll(".sort-option");
    let currentSort = "latest";

    /* ==========================
       SORT DROPDOWN TOGGLE
    =========================== */
    if (sortBtn && sortMenu) {
        sortBtn.addEventListener("click", function (e) {
            e.stopPropagation();
            sortMenu.classList.toggle("open");
        });

        // Close sort menu when clicking outside
        document.addEventListener("click", function () {
            sortMenu.classList.remove("open");
        });

        // Sort option selection
        sortOptions.forEach((option) => {
            option.addEventListener("click", function () {
                sortOptions.forEach((opt) => opt.classList.remove("active"));
                this.classList.add("active");
                currentSort = this.dataset.value;
                document.getElementById("sortText").textContent =
                    this.textContent.trim();
                sortMenu.classList.remove("open");
                applyAllFilters();
            });
        });
    }

    /* ==========================
       FILTER SIDEBAR TOGGLE
    =========================== */
    if (filterToggleBtn && filterSidebar) {
        filterToggleBtn.addEventListener("click", function () {
            filterSidebar.classList.add("open");
            filterOverlay.classList.add("active");
        });
    }

    if (closeFilter) {
        closeFilter.addEventListener("click", function () {
            filterSidebar.classList.remove("open");
            filterOverlay.classList.remove("active");
        });
    }

    if (filterOverlay) {
        filterOverlay.addEventListener("click", function () {
            filterSidebar.classList.remove("open");
            filterOverlay.classList.remove("active");
        });
    }

    /* ==========================
       FUNCTION: APPLY FILTERS (REAL-TIME)
    =========================== */
    function applyAllFilters() {
        let searchWord = searchInput ? searchInput.value.toLowerCase() : "";
        let activeCategory = "all";

        // Get active category
        const activeCategoryBtn = document.querySelector(
            ".category-pill.active"
        );
        if (activeCategoryBtn) {
            activeCategory = activeCategoryBtn.dataset.category || "all";
        }

        let minP = minPrice && minPrice.value ? parseInt(minPrice.value) : 0;
        let maxP =
            maxPrice && maxPrice.value ? parseInt(maxPrice.value) : Infinity;

        let stockSelected = Array.from(stockCheckboxes)
            .filter((cb) => cb.checked)
            .map((cb) => cb.value);

        // AJAX call for real-time filtering
        fetch("/api/produk/filter", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN":
                    document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute("content") || "",
            },
            body: JSON.stringify({
                search: searchWord,
                category: activeCategory,
                min_price: minPrice ? minPrice.value : "",
                max_price: maxPrice ? maxPrice.value : "",
                stock_status: stockSelected,
                sort: currentSort,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                // Update products grid
                if (productsGrid && data.html) {
                    productsGrid.innerHTML = data.html;
                }

                // Re-bind events to new elements
                bindEventsToNewElements();
            })
            .catch((error) => {
                console.error("Error:", error);
                // Fallback to client-side filtering
                fallbackClientSideFilter(
                    searchWord,
                    activeCategory,
                    minP,
                    maxP,
                    stockSelected
                );
            });
    }

    function fallbackClientSideFilter(
        searchWord,
        activeCategory,
        minP,
        maxP,
        stockSelected
    ) {
        if (!cards) return;

        cards.forEach((card) => {
            let name = card.dataset.name || "";
            let category = card.dataset.category || "";
            let price = parseInt(card.dataset.price) || 0;
            let stock = parseInt(card.dataset.stock) || 0;

            let visible = true;

            /* SEARCH */
            if (searchWord && !name.includes(searchWord)) visible = false;

            /* CATEGORY */
            if (activeCategory !== "all" && category !== activeCategory)
                visible = false;

            /* PRICE RANGE */
            if (price < minP || price > maxP) visible = false;

            /* STOCK */
            if (stockSelected.length > 0) {
                let stockVisible = false;
                if (stockSelected.includes("available") && stock > 5)
                    stockVisible = true;
                if (stockSelected.includes("low") && stock > 0 && stock <= 5)
                    stockVisible = true;
                if (stockSelected.includes("out") && stock === 0)
                    stockVisible = true;
                if (!stockVisible) visible = false;
            }

            /* APPLY */
            card.style.display = visible ? "" : "none";
        });
    }

    function bindEventsToNewElements() {
        // Re-bind quick view buttons
        const newQuickViewButtons = document.querySelectorAll(".quick-view");
        newQuickViewButtons.forEach((btn) => {
            btn.addEventListener("click", function () {
                const productId = this.dataset.productId;
                fetchProductDetails(productId);
            });
        });

        // Re-bind add to cart buttons
        const newAddToCartButtons = document.querySelectorAll(".add-to-cart");
        newAddToCartButtons.forEach((btn) => {
            btn.addEventListener("click", function () {
                const productId = this.dataset.productId;
                const productName = this.dataset.name;
                alert(
                    `Produk "${productName}" telah ditambahkan ke keranjang!`
                );
            });
        });
    }

    /* ==========================
       CATEGORY FILTER
    =========================== */
    categoryButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            categoryButtons.forEach((b) => b.classList.remove("active"));
            this.classList.add("active");
            applyAllFilters();
        });
    });

    /* ==========================
       SEARCH REALTIME (DEBOUNCED)
    =========================== */
    let searchTimeout;
    if (searchInput) {
        searchInput.addEventListener("input", function () {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(applyAllFilters, 300); // 300ms debounce
        });
    }

    /* ==========================
       PRICE RANGE
    =========================== */
    if (minPrice) minPrice.addEventListener("input", applyAllFilters);
    if (maxPrice) maxPrice.addEventListener("input", applyAllFilters);

    /* ==========================
       STOCK CHECKBOXES
    =========================== */
    stockCheckboxes.forEach((cb) => {
        cb.addEventListener("change", applyAllFilters);
    });

    /* ==========================
       CLEAR SEARCH
    =========================== */
    window.clearSearch = function () {
        if (searchInput) {
            searchInput.value = "";
            applyAllFilters();
        }
    };

    /* ==========================
       RESET FILTERS
    =========================== */
    window.resetFilters = function () {
        if (minPrice) minPrice.value = "";
        if (maxPrice) maxPrice.value = "";
        stockCheckboxes.forEach((cb) => (cb.checked = true));
        applyAllFilters();
    };

    window.resetAllFilters = function () {
        if (searchInput) searchInput.value = "";
        if (minPrice) minPrice.value = "";
        if (maxPrice) maxPrice.value = "";
        stockCheckboxes.forEach((cb) => (cb.checked = true));

        categoryButtons.forEach((b) => b.classList.remove("active"));
        if (categoryButtons.length > 0) {
            categoryButtons[0].classList.add("active");
        }

        applyAllFilters();
    };

    /* ==========================
       APPLY FILTERS BUTTON
    =========================== */
    const applyFiltersBtn = document.querySelector(
        ".filter-sidebar-footer .btn-success"
    );
    if (applyFiltersBtn) {
        applyFiltersBtn.addEventListener("click", function () {
            filterSidebar.classList.remove("open");
            filterOverlay.classList.remove("active");
            applyAllFilters();
        });
    }

    /* ==========================
       VIEW TOGGLE
    =========================== */
    const viewButtons = document.querySelectorAll(".view-btn");
    viewButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            viewButtons.forEach((b) => b.classList.remove("active"));
            this.classList.add("active");

            const view = this.dataset.view;
            if (productsGrid) {
                if (view === "list") {
                    productsGrid.classList.add("list-view");
                } else {
                    productsGrid.classList.remove("list-view");
                }
            }
        });
    });

    /* ==========================
       QUICK VIEW MODAL
    =========================== */
    const quickViewButtons = document.querySelectorAll(".quick-view");
    quickViewButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            const productId = this.dataset.productId;
            fetchProductDetails(productId);
        });
    });

    function fetchProductDetails(productId) {
        // Find product data from existing cards
        const productCard = document.querySelector(
            `[data-product-id="${productId}"]`
        );
        if (productCard) {
            const name = productCard
                .querySelector(".product-title a")
                .textContent.trim();
            const price =
                productCard.querySelector(".current-price").textContent;
            const stock = productCard.querySelector(
                ".product-stock-info span"
            ).textContent;
            const description = productCard
                .querySelector(".product-description")
                .textContent.trim();
            const image = productCard.querySelector("img").src;
            const category =
                productCard.querySelector(".product-category").textContent;
            const slug = productCard.dataset.slug;

            // Populate modal
            const modalImage = document.getElementById("modalProductImage");
            const modalCategory = document.getElementById(
                "modalProductCategory"
            );
            const modalName = document.getElementById("modalProductName");
            const modalPrice = document.getElementById("modalProductPrice");
            const modalStock = document.getElementById("modalProductStock");
            const modalDescription = document.getElementById(
                "modalProductDescription"
            );
            const modalViewBtn = document.getElementById("modalViewFullBtn");
            const modalAddToCartBtn =
                document.getElementById("modalAddToCartBtn");

            if (modalImage) modalImage.src = image;
            if (modalCategory) modalCategory.textContent = category;
            if (modalName) modalName.textContent = name;
            if (modalPrice) modalPrice.textContent = price;
            if (modalStock) modalStock.textContent = stock;
            if (modalDescription) modalDescription.textContent = description;
            if (modalViewBtn)
                modalViewBtn.href = `/produk/${slug || productId}`;
            if (modalAddToCartBtn)
                modalAddToCartBtn.dataset.productId = productId;

            // Show modal
            const modal = new bootstrap.Modal(
                document.getElementById("quickViewModal")
            );
            modal.show();
        }
    }

    /* ==========================
       ADD TO CART
    =========================== */
    const addToCartButtons = document.querySelectorAll(".add-to-cart");
    addToCartButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            const productId = this.dataset.productId;
            const productName = this.dataset.name;

            // Simple alert for now - can be replaced with actual cart functionality
            alert(`Produk "${productName}" telah ditambahkan ke keranjang!`);
        });
    });

    // Modal add to cart button
    const modalAddToCartBtn = document.getElementById("modalAddToCartBtn");
    if (modalAddToCartBtn) {
        modalAddToCartBtn.addEventListener("click", function () {
            const productId = this.dataset.productId;
            alert("Produk telah ditambahkan ke keranjang!");
        });
    }
});
