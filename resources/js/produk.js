document.addEventListener("DOMContentLoaded", function () {

    const cards = document.querySelectorAll(".product-card");
    const searchInput = document.getElementById("productSearch");
    const productsGrid = document.getElementById("productsGrid");

    /* Category pills */
    const categoryButtons = document.querySelectorAll(".category-pill");

    /* Filter sidebar */
    const filterToggle = document.getElementById("filterToggleBtn");
    const filterPanel = document.getElementById("filterSidebar");
    const filterOverlay = document.getElementById("filterOverlay");
    const closeFilter = document.getElementById("closeFilter");

    /* Price */
    const minPrice = document.getElementById("minPrice");
    const maxPrice = document.getElementById("maxPrice");

    /* Stock */
    const stockCheckboxes = document.querySelectorAll(".stock-status-options input[type='checkbox']");

    /* Sort options */
    const sortOptions = document.querySelectorAll(".sort-option");

    let currentSort = "latest";

    /* ==========================
       Open/Close Filter Sidebar
    =========================== */
    filterToggle.addEventListener("click", () => {
        filterPanel.classList.add("active");
        filterOverlay.classList.add("active");
    });

    closeFilter.addEventListener("click", () => {
        filterPanel.classList.remove("active");
        filterOverlay.classList.remove("active");
    });

    filterOverlay.addEventListener("click", () => {
        filterPanel.classList.remove("active");
        filterOverlay.classList.remove("active");
    });

    /* ==========================
       APPLY FILTERS (Client-side)
    =========================== */
    function applyFilters() {
        const search = searchInput.value.toLowerCase();
        const min = minPrice.value ? parseInt(minPrice.value) : 0;
        const max = maxPrice.value ? parseInt(maxPrice.value) : Infinity;

        const activeCategory = document.querySelector(".category-pill.active").dataset.category;

        const stockSelected = Array.from(stockCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        cards.forEach(card => {
            const name = card.dataset.name;
            const category = card.dataset.category;
            const price = parseInt(card.dataset.price);
            const stock = parseInt(card.dataset.stock);

            let visible = true;

            if (!name.includes(search)) visible = false;
            if (activeCategory !== "all" && category !== activeCategory) visible = false;
            if (price < min || price > max) visible = false;

            let stockVisible = false;
            if (stock > 5 && stockSelected.includes("available")) stockVisible = true;
            if (stock > 0 && stock <= 5 && stockSelected.includes("low")) stockVisible = true;
            if (stock <= 0 && stockSelected.includes("out")) stockVisible = true;
            if (!stockVisible) visible = false;

            card.style.display = visible ? "" : "none";
        });

        applySorting();
    }

    /* ==========================
       SORTING
    =========================== */
    function applySorting() {
        let items = Array.from(document.querySelectorAll(".product-card"))
            .filter(card => card.style.display !== "none");

        if (currentSort === "price-low") {
            items.sort((a, b) => a.dataset.price - b.dataset.price);
        } else if (currentSort === "price-high") {
            items.sort((a, b) => b.dataset.price - a.dataset.price);
        } else if (currentSort === "name-asc") {
            items.sort((a, b) => a.dataset.name.localeCompare(b.dataset.name));
        } else if (currentSort === "name-desc") {
            items.sort((a, b) => b.dataset.name.localeCompare(a.dataset.name));
        }

        items.forEach(item => productsGrid.appendChild(item));
    }

    sortOptions.forEach(option => {
        option.addEventListener("click", function () {
            sortOptions.forEach(o => o.classList.remove("active"));
            this.classList.add("active");

            currentSort = this.dataset.value;
            applyFilters();
        });
    });

    /* ==========================
       EVENT HANDLERS
    =========================== */
    searchInput.addEventListener("input", applyFilters);
    minPrice.addEventListener("input", applyFilters);
    maxPrice.addEventListener("input", applyFilters);
    stockCheckboxes.forEach(cb => cb.addEventListener("change", applyFilters));

    categoryButtons.forEach(btn => {
        btn.addEventListener("click", function () {
            categoryButtons.forEach(b => b.classList.remove("active"));
            this.classList.add("active");
            applyFilters();
        });
    });

    /* Reset */
    window.resetFilters = function () {
        minPrice.value = "";
        maxPrice.value = "";
        stockCheckboxes.forEach(cb => cb.checked = true);
        applyFilters();
    };

    window.resetAllFilters = function () {
        searchInput.value = "";
        minPrice.value = "";
        maxPrice.value = "";
        stockCheckboxes.forEach(cb => cb.checked = true);

        categoryButtons.forEach(b => b.classList.remove("active"));
        document.querySelector('[data-category="all"]').classList.add("active");

        applyFilters();
    };

    /* Initial run */
    applyFilters();

});
