document.addEventListener('DOMContentLoaded', () => {
    // === Fungsi untuk Menampilkan & Menyembunyikan Popup ===
    function showPopup(popupElement) {
        popupElement.style.display = 'flex';
    }

    function hidePopup(popupElement) {
        popupElement.style.display = 'none';
    }

    // === Login Admin ===
    const adminLink = document.getElementById('admin-link');
    const loginPopupAdmin = document.getElementById('login-popup-admin');
    const closePopupAdmin = document.getElementById('close-popup-admin');

    adminLink.addEventListener('click', (e) => {
        e.preventDefault();
        showPopup(loginPopupAdmin);
    });

    closePopupAdmin.addEventListener('click', () => {
        hidePopup(loginPopupAdmin);
    });

    loginPopupAdmin.addEventListener('click', (e) => {
        if (e.target === loginPopupAdmin) {
            hidePopup(loginPopupAdmin);
        }
    });

    // === Login Umum (Siswa/Guru) ===
    const umumLoginBtn = document.getElementById('umum-login-btn');
    const loginPopupUmum = document.getElementById('login-popup-umum');
    const closePopupUmum = document.getElementById('close-popup-umum');

    umumLoginBtn.addEventListener('click', (e) => {
        e.preventDefault();
        showPopup(loginPopupUmum);
    });

    closePopupUmum.addEventListener('click', () => {
        hidePopup(loginPopupUmum);
    });

    loginPopupUmum.addEventListener('click', (e) => {
        if (e.target === loginPopupUmum) {
            hidePopup(loginPopupUmum);
        }
    });

    // === Pilihan Login Siswa/Guru ===
    const btnSiswa = document.getElementById('btn-siswa');
    const btnGuru = document.getElementById('btn-guru');
    const formSiswa = document.getElementById('login-form-umum-siswa');
    const formGuru = document.getElementById('login-form-umum-guru');

    btnSiswa.addEventListener('click', () => {
        btnSiswa.classList.add('active');
        btnGuru.classList.remove('active');
        formSiswa.style.display = 'block';
        formGuru.style.display = 'none';
    });

    btnGuru.addEventListener('click', () => {
        btnGuru.classList.add('active');
        btnSiswa.classList.remove('active');
        formGuru.style.display = 'block';
        formSiswa.style.display = 'none';
    });

    // === Register Siswa/Guru ===
    const registerPopup = document.getElementById('register-popup');
    const showRegisterForm = document.getElementById('show-register-form');
    const showLoginForm = document.getElementById('show-login-form');
    const closeRegisterPopup = document.getElementById('close-register-popup');

    showRegisterForm.addEventListener('click', (e) => {
        e.preventDefault();
        hidePopup(loginPopupUmum);
        showPopup(registerPopup);
    });

    showLoginForm.addEventListener('click', (e) => {
        e.preventDefault();
        hidePopup(registerPopup);
        showPopup(loginPopupUmum);
    });

    closeRegisterPopup.addEventListener('click', () => {
        hidePopup(registerPopup);
    });

    registerPopup.addEventListener('click', (e) => {
        if (e.target === registerPopup) {
            hidePopup(registerPopup);
        }
    });

    // === Pilihan Register Siswa/Guru ===
    const btnRegSiswa = document.getElementById('btn-reg-siswa');
    const btnRegGuru = document.getElementById('btn-reg-guru');
    const formRegSiswa = document.getElementById('register-form-siswa');
    const formRegGuru = document.getElementById('register-form-guru');

    btnRegSiswa.addEventListener('click', () => {
        btnRegSiswa.classList.add('active');
        btnRegGuru.classList.remove('active');
        formRegSiswa.style.display = 'block';
        formRegGuru.style.display = 'none';
    });

    btnRegGuru.addEventListener('click', () => {
        btnRegGuru.classList.add('active');
        btnRegSiswa.classList.remove('active');
        formRegGuru.style.display = 'block';
        formRegSiswa.style.display = 'none';
    });

    // === Deteksi Mapel: Biasa atau Jurusan ===
    const mapelInput = document.getElementById("mapel-input");
    const mapelHidden = document.getElementById("mapel-hidden");
    const mapelJurusanHidden = document.getElementById("mapeljurusan-hidden");

    const mapelJurusanList = ["rpl", "dpib", "dgm", "dkv", "tkr", "titl", "sija", "tkj", "tkp", "tpm"];
    const mapelBiasaList = ["b indo", "b inggris", "matematika", "ipas", "olga"];

    if (mapelInput) {
        mapelInput.addEventListener("input", function () {
            const val = this.value.trim().toLowerCase();

            if (mapelJurusanList.includes(val)) {
                mapelHidden.value = '';
                mapelJurusanHidden.value = val;
            } else if (mapelBiasaList.includes(val)) {
                mapelHidden.value = val;
                mapelJurusanHidden.value = '';
            } else {
                mapelHidden.value = '';
                mapelJurusanHidden.value = '';
            }
        });
    }


});
