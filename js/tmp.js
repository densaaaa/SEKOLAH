document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi elemen popup
    const nilaiMenuLink = document.getElementById('nilai-menu-link');
    const nilaiPopupContainer = document.getElementById('nilai-popup-container');
    const nilaiPopupClose = document.querySelector('.nilai-popup-close');
    const nilaiTypeSelectors = document.querySelectorAll('.nilai-type-selector');
    const nilaiSiswaForm = document.getElementById('nilai-siswa-form');
    const nilaiGuruForm = document.getElementById('nilai-guru-form');

    // Handling popup login jika elemen ada
    if (nilaiPopupContainer) {
        // Tampilkan popup login
        if (nilaiMenuLink) {
            nilaiMenuLink.addEventListener('click', function(e) {
                e.preventDefault();
                nilaiPopupContainer.style.display = 'flex';
                // Gunakan requestAnimationFrame untuk animasi yang lebih baik
                requestAnimationFrame(() => {
                    nilaiPopupContainer.classList.add('active');
                });
            });
        } else {
            console.error("Elemen #nilai-menu-link tidak ditemukan!");
        }

        // Tutup popup login
        if (nilaiPopupClose) {
            nilaiPopupClose.addEventListener('click', function() {
                nilaiPopupContainer.classList.remove('active');
                setTimeout(() => {
                    nilaiPopupContainer.style.display = 'none';
                }, 300);
            });
        } else {
            console.error("Elemen .nilai-popup-close tidak ditemukan!");
        }

        // Klik di luar form untuk menutup popup
        nilaiPopupContainer.addEventListener('click', function(e) {
            if (e.target === nilaiPopupContainer) {
                nilaiPopupContainer.classList.remove('active');
                setTimeout(() => {
                    nilaiPopupContainer.style.display = 'none';
                }, 300);
            }
        });

        // Switch antara login siswa/guru
        if (nilaiTypeSelectors.length > 0 && nilaiSiswaForm && nilaiGuruForm) {
            nilaiTypeSelectors.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    nilaiTypeSelectors.forEach(b => b.classList.remove('selected'));
                    this.classList.add('selected');
                    const loginType = this.getAttribute('data-type');
                    nilaiSiswaForm.style.display = loginType === 'siswa' ? 'block' : 'none';
                    nilaiGuruForm.style.display = loginType === 'guru' ? 'block' : 'none';
                    
                    // Set input hidden pada form yang aktif
                    if (loginType === 'siswa' && nilaiSiswaForm.querySelector('input[name="role"]')) {
                        nilaiSiswaForm.querySelector('input[name="role"]').value = 'siswa';
                    } else if (loginType === 'guru' && nilaiGuruForm.querySelector('input[name="role"]')) {
                        nilaiGuruForm.querySelector('input[name="role"]').value = 'guru';
                    }
                });
            });
            
            // Tambahkan event listener untuk form submission
            if (nilaiSiswaForm) {
                nilaiSiswaForm.addEventListener('submit', handleFormSubmit);
            }
            if (nilaiGuruForm) {
                nilaiGuruForm.addEventListener('submit', handleFormSubmit);
            }
        } else {
            console.error("Elemen form siswa/guru atau selector tidak ditemukan!");
        }
    } else {
        console.error("Elemen #nilai-popup-container tidak ditemukan!");
    }
    
    // Fungsi untuk menangani submit form
    // function handleFormSubmit(e) {
    //     e.preventDefault();
        
    //     const form = e.target;
    //     const formData = new FormData(form);
        
    //     fetch('loginilai.php', {
    //         method: 'POST',
    //         body: formData
    //     })
    //     .then(response => {
    //         if (!response.ok) {
    //             throw new Error('Network response was not ok');
    //         }
    //         return response.text();
    //     })
    //     .then(data => {
    //         if (data.startsWith('success:')) {
    //             // Jika sukses, redirect ke halaman yang ditentukan
    //             const redirectUrl = data.split(':')[1];
    //             window.location.href = redirectUrl;
    //         } else {
    //             // Tampilkan pesan error
    //             alert(data || 'Terjadi kesalahan pada server');
    //         }
    //     })
    //     .catch(error => {
    //         console.error('Error:', error);
    //         alert('Terjadi kesalahan: ' + error.message);
    //     });
    // }


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

    // Kode untuk animasi statistik saat scroll
    // Select all stat number elements
    const statNumbers = document.querySelectorAll('.stat-number');
    
    // Store the target values and formatting info for each counter
    const targetValues = [];
    const hasPercentage = [];
    
    statNumbers.forEach((stat, index) => {
        // Get the original text content
        const originalText = stat.textContent.trim();
        
        // Check if the number has a percentage sign
        hasPercentage[index] = originalText.includes('%');
        
        // Extract the numeric value
        const numericValue = parseFloat(originalText.replace(/[^0-9.]/g, ''));
        targetValues[index] = numericValue;
        
        // Set initial value to 0 (with % if needed)
        stat.textContent = hasPercentage[index] ? '0%' : '0';
    });
    
    // Function to check if element is in viewport
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }
    
    // Function to animate counting
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
    
    // Add scroll event listener
    window.addEventListener('scroll', handleScrollStats);
    
    // Check if stats section is already visible on page load
    handleScrollStats();
});