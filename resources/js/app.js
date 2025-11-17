import './bootstrap';

// --- Variabel Konfigurasi ---
const FADE_OUT_DURATION = 700; // Durasi transisi CSS di Tailwind
const ADDITIONAL_DELAY = 700;  // Delay tambahan setelah semua aset dimuat (0.7 detik)

// // --- Logika Progress Bar ---
// function updateProgress() {
//     const scrollProgress = document.getElementById('scroll-progress');
//     const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    
//     if (!scrollProgress || docHeight <= 0) return; 

//     const scrollTop = window.scrollY;
//     const scrollPercent = (scrollTop / docHeight) * 100;
//     scrollProgress.style.width = scrollPercent + '%';
// }

// --- Logika Utama Preloader ---
function hidePreloaderAndStartScroll() {
    const preloader = document.getElementById('preloader');
    
    if (preloader) {
        // 1. Mulai transisi fade out Preloader
        preloader.classList.add('opacity-0');

        // 2. Setelah transisi selesai (700ms):
        setTimeout(() => {
            // Hapus Preloader & Aktifkan kembali scroll
            preloader.remove(); 
            document.body.style.overflow = 'auto';

            // 3. AKTIFKAN PROGRESS BAR
            window.addEventListener('scroll', updateProgress);
            updateProgress(); // Panggil sekali untuk posisi awal
            
        }, FADE_OUT_DURATION); 
    }
}

// --- INISIASI ---
// 1. Kunci scroll segera (Ini harus dieksekusi duluan)
document.body.style.overflow = 'hidden';

// 2. Tunggu SEMUA aset halaman selesai dimuat
window.addEventListener('load', function() {
    // Terapkan delay tambahan, lalu jalankan fungsi penghilangan Preloader
    setTimeout(hidePreloaderAndStartScroll, ADDITIONAL_DELAY);
});


 
        window.addEventListener('scroll', function() {
            const scrollProgress = document.getElementById('scroll-progress');
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            scrollProgress.style.width = scrollPercent + '%';
        });
    