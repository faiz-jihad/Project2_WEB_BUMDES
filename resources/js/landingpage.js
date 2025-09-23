// Carousel for Berita (News)
(() => {
    const carousel = document.querySelector(".news-carousel");
    const prevBtn = document.querySelector(".prev-btn");
    const nextBtn = document.querySelector(".next-btn");

    if (!carousel || !prevBtn || !nextBtn) return;

    const scrollAmount = 320;

    prevBtn.addEventListener("click", () => {
        carousel.scrollBy({
            left: -scrollAmount,
            behavior: "smooth",
        });
    });

    nextBtn.addEventListener("click", () => {
        carousel.scrollBy({
            left: scrollAmount,
            behavior: "smooth",
        });
    });
})();

// Carousel for Foto Kegiatan (Activity Photos)
(() => {
    const images = document.querySelectorAll(".activity-image");
    const prevBtn = document.querySelector(".prev-activity-btn");
    const nextBtn = document.querySelector(".next-activity-btn");

    if (images.length === 0 || !prevBtn || !nextBtn) return;

    let currentIndex = 0;

    function showImage(index) {
        images.forEach((img, i) => {
            img.classList.toggle("hidden", i !== index);
        });
    }

    prevBtn.addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        showImage(currentIndex);
    });

    nextBtn.addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % images.length;
        showImage(currentIndex);
    });

    // Initialize first image visibility
    showImage(currentIndex);
})();
