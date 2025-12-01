  <!-- Navbar -->
  <header class="w-full fixed top-0 left-0 bg-white shadow-md z-50">
      <div class="container mx-auto flex justify-between items-center px-6 py-3">


          <!-- Kiri atas: Email & Telepon -->
          <div class="flex flex-row text-sm text-gray-600 gap-6 items-center">
              <!-- Email -->
              <a href="mailto:dhuahdc@gmail.com" class="hover:text-[#02104A] flex items-center gap-2">
                  <img src="{{ asset('img/email.png') }}" alt="Email" class="h-9 w-auto">
                  <!-- 🔹 Ganti emoji jadi gambar -->
                  <span>dhuahdc@gmail.com</span>
              </a>

              <!-- Telepon -->
              <a href="tel:+6285272201996" class="hover:text-[#02104A] flex items-center gap-2">
                  <img src="{{ asset('img/telpon.png') }}" alt="Telepon" class="h-9 w-auto">
                  <!-- 🔹 Ganti emoji jadi gambar -->
                  <span>+6285272201996</span>
              </a>
          </div>


          <!-- Kanan atas: Hubungi Kami + Logo Sosial Media -->
          <div class="flex items-center gap-3 mr-[65px]">
              <span class="text-sm font-semibold text-gray-700">Hubungi kami :</span>
              <div class="flex items-center gap-3">
                  <a href="#" class="hover:opacity-80">
                      <img src="{{ asset('img/fb.png') }}" alt="Facebook" class="h-11 w-auto">
                  </a>
                  <a href="#" class="hover:opacity-80">
                      <img src="{{ asset('img/ig.png') }}" alt="Instagram" class="h-11 w-auto">
                  </a>
                  <a href="#" class="hover:opacity-80">
                      <img src="{{ asset('img/wa.png') }}" alt="WhatsApp" class="h-11 w-auto">
                  </a>
              </div>
          </div>
      </div>
  </header>
