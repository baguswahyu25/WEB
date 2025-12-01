<!-- Navbar -->
<header class="fixed top-0 left-0 w-full bg-white shadow-md z-50">
    <div class="container mx-auto flex items-center justify-between px-8 py-3">

        <!-- Logo -->
        <div class="flex items-center gap-2">
            <a href="{{ url('/#home') }}">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-11 w-auto">
            </a>
        </div>

        <!-- Navigation Menu -->
        <nav class="hidden md:flex items-center gap-10 text-[16px] font-medium text-[#02104A]">
            <a href="{{ url('/#home') }}"
                class="scroll-link hover:text-blue-800 transition duration-300 ease-in-out transform hover:-translate-y-0.4">Beranda</a>
            <a href="{{ url('/#tentang') }}"
                class="scroll-link hover:text-blue-800 transition duration-300 ease-in-out transform hover:-translate-y-0.4">Tentang
                Kami</a>
            <a href="{{ url('/#layanan') }}"
                class="scroll-link hover:text-blue-800 transition duration-300 ease-in-out transform hover:-translate-y-0.4">Layanan
                Kami</a>
            <a href="{{ url('/#paket') }}"
                class="scroll-link hover:text-blue-800 transition duration-300 ease-in-out transform hover:-translate-y-0.4">Paket
                Kursus</a>
            <a href="{{ url('/#support') }}"
                class="scroll-link hover:text-blue-800 transition duration-300 ease-in-out transform hover:-translate-y-0.4">Support</a>
        </nav>

        <!-- Login Button -->
        <a href="/login"
            class="bg-[#02104A] hover:bg-blue-800 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-0.5">
            Login
        </a>


    </div>
</header>

<!-- Tambahkan script untuk smooth scroll -->
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Jalankan hanya di halaman utama
        if (window.location.pathname === '/' || window.location.pathname === '/index') {
            document.querySelectorAll('a.scroll-link').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const targetId = this.getAttribute('href').split('#')[1];
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        e.preventDefault();
                        const offset = targetElement.offsetTop - 80; // tinggi navbar
                        window.scrollTo({
                            top: offset,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        }
    });
</script> --}}
