// Inisialisasi elemen carousel
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');
const prevBtn = document.querySelector('.carousel-btn.left');
const nextBtn = document.querySelector('.carousel-btn.right');

// Hanya jalankan carousel jika elemen-elemennya ada
if (slides.length > 0 && dots.length > 0) {
    let currentSlide = 0;
    const slideInterval = 5000;
    let slideTimer;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove('active', 'prev');
            if (dots[i]) dots[i].classList.remove('active');

            if (i === index) {
                slide.classList.add('active');
            } else if (i === (index - 1 + slides.length) % slides.length) {
                slide.classList.add('prev');
            }
        });

        if (dots[index]) dots[index].classList.add('active');
        currentSlide = index;
    }

    function nextSlide() {
        let nextIndex = (currentSlide + 1) % slides.length;
        showSlide(nextIndex);
    }

    function prevSlide() {
        let prevIndex = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prevIndex);
    }

    // Stop timer when page is not visible
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            clearInterval(slideTimer);
        } else {
            slideTimer = setInterval(nextSlide, slideInterval);
        }
    });

    // Event listener tombol next/prev
    if (nextBtn && prevBtn) {
        nextBtn.addEventListener('click', function() {
            clearInterval(slideTimer);
            nextSlide();
            slideTimer = setInterval(nextSlide, slideInterval);
        });

        prevBtn.addEventListener('click', function() {
            clearInterval(slideTimer);
            prevSlide();
            slideTimer = setInterval(nextSlide, slideInterval);
        });
    }

    // Event listener dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', function() {
            clearInterval(slideTimer);
            showSlide(index);
            slideTimer = setInterval(nextSlide, slideInterval);
        });
    });

    // Tambahkan swipe detection untuk perangkat mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    const carouselContainer = slides[0].parentElement;
    if (carouselContainer) {
        carouselContainer.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        }, false);
        
        carouselContainer.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, false);
    }
    
    function handleSwipe() {
        const swipeThreshold = 50; // Minimum jarak swipe untuk trigger slide
        
        if (touchStartX - touchEndX > swipeThreshold) {
            // Swipe left, next slide
            clearInterval(slideTimer);
            nextSlide();
            slideTimer = setInterval(nextSlide, slideInterval);
        }
        if (touchEndX - touchStartX > swipeThreshold) {
            // Swipe right, previous slide
            clearInterval(slideTimer);
            prevSlide();
            slideTimer = setInterval(nextSlide, slideInterval);
        }
    }

    // Auto-slide setiap 5 detik
    slideTimer = setInterval(nextSlide, slideInterval);

    // Tampilkan slide pertama saat halaman dimuat
    showSlide(0);
} else {
    console.error("Elemen carousel tidak ditemukan!");
}

function animateCounter(element, start, end, duration, isPercentage) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        let currentValue = progress * (end - start) + start;
        
        // Format the number based on whether it's a percentage or not
        if (isPercentage) {
            // For percentages, show one decimal place
            element.textContent = currentValue.toFixed(1) + '%';
        } else {
            // For regular numbers, use locale string without decimals
            element.textContent = Math.floor(currentValue).toLocaleString();
        }
        
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

// Variable to track if animation has been triggered
let animated = false;

// Function to handle scroll event
function handleScrollStats() {
    // Only proceed if not already animated and if stats section exists
    const statsSection = document.querySelector('.stats');
    if (!animated && statsSection && isElementInViewport(statsSection)) {
        animated = true;
        
        // Animate each stat number
        statNumbers.forEach((stat, index) => {
            // Use different durations for larger numbers to make animation smooth
            const duration = Math.min(2000 + (targetValues[index] / 1000), 3000);
            animateCounter(stat, 0, targetValues[index], duration, hasPercentage[index]);
        });
        
        // Remove scroll listener after animation is triggered
        window.removeEventListener('scroll', handleScrollStats);
    }
}