  <!-- Footer -->
  <footer class="bg-[#02104A] text-white py-8">
      <div class="container mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 md:gap-3 items-start">

          <!-- Logo -->
          <div class="flex justify-center md:justify-start mt-[-10px]">
              <img src="{{ asset('img/logop.png') }}" alt="Logo" class="h-[125px] md:h-[115px] w-auto">
          </div>

          <!-- Tautan Fitur -->
          <div class="text-center sm:text-left">
              <h3 class="font-semibold mb-2">Tautan Fitur</h3>
              <ul class="text-sm space-y-2">

                  <!-- LIST ITEM DENGAN IKON -->
                  <li>
                      <a href="#" class="flex items-center gap-2 hover:underline">
                          <!-- Placeholder Ikon: Ganti dengan <img src="..."> Anda -->
                          {{-- <img src="{{ asset('img/lbes.png') }}" class="w-4 h-4 flex-shrink-0" alt="Icon"> --}}
                          Beranda
                      </a>
                  </li>
                  <li>
                      <a href="#" class="flex items-center gap-2 hover:underline">
                          {{-- <img src="{{ asset('img/lbes.png') }}" class="w-4 h-4 flex-shrink-0" alt="Icon"> --}}
                          Tentang Kami
                      </a>
                  </li>
                  <li>
                      <a href="#" class="flex items-center gap-2 hover:underline">
                          {{-- <img src="{{ asset('img/lbes.png') }}" class="w-4 h-4 flex-shrink-0" alt="Icon"> --}}
                          Kursus
                      </a>
                  </li>
                  <li>
                      <a href="#" class="flex items-center gap-2 hover:underline">
                          {{-- <img src="{{ asset('img/lbes.png') }}" class="w-4 h-4 flex-shrink-0" alt="Icon"> --}}
                          Jual Beli Unit
                      </a>
                  </li>
                  <li>
                      <a href="#" class="flex items-center gap-2 hover:underline">
                          {{-- <img src="{{ asset('img/lbes.png') }}" class="w-4 h-4 flex-shrink-0" alt="Icon"> --}}
                          Support
                      </a>
                  </li>

              </ul>
          </div>

          <!-- Support -->
          <div class="text-center sm:text-left">
              <h3 class="font-semibold mb-2">Support</h3>
              <ul class="text-sm space-y-2">

                  <!-- LIST ITEM DENGAN IKON -->
                  <li>
                      <a href="#" class="flex items-center gap-2 hover:underline">
                          {{-- <img src="{{ asset('img/lbes.png') }}" class="w-4 h-4 flex-shrink-0" alt="Icon"> --}}
                          Certivicate Holder
                      </a>
                  </li>
                  <li>
                      <a href="#" class="flex items-center gap-2 hover:underline">
                          {{-- <img src="{{ asset('img/lbes.png') }}" class="w-4 h-4 flex-shrink-0" alt="Icon"> --}}
                          Support
                      </a>
                  </li>

              </ul>
          </div>

          <!-- Info Kontak (Tidak Berubah) -->
          <div class="text-center sm:text-left">
              <p class="font-semibold mb-2">Belajar Mengemudi Dhuha Bengkalis</p>
              <ul class="text-sm space-y-3">

                  <!-- Lokasi -->
                  <li class="flex flex-col sm:flex-row items-center sm:items-start gap-2">
                      <img src="{{ asset('img/mp.png') }}" alt="Lokasi" class="h-7 w-auto">
                      <a target="_blank"
                          href="https://www.google.com/maps/place/6PH4F4QH%2BH6M/@1.4889518,102.1280318,21z/data=!4m4!3m3!8m2!3d1.4889625!4d102.1280469?entry=ttu&g_ep=EgoyMDI1MTAyOS4yIKXMDSoASAFQAw%3D%3D">
                          <p class="leading-6 text-center sm:text-left">
                              F4QH+H6M, Wonosari, Bengkalis Sub-District, Riau 28711
                          </p>
                      </a>
                  </li>

                  <!-- Telepon -->
                  <li class="flex flex-col sm:flex-row items-center sm:items-start gap-2">
                      <img src="{{ asset('img/tlp.png') }}" alt="Telepon" class="h-7 w-auto">
                      <a target="_blank" href="https://wa.me/+6285272201996">
                          <p>+6285272201996</p>
                      </a>
                  </li>

                  <!-- Email -->
                  <li class="flex flex-col sm:flex-row items-center sm:items-start gap-2">
                      <img src="{{ asset('img/email.png') }}" alt="Email" class="h-7 w-auto">
                      <a href="mailto:dhuahdc@gmail.com" target="_blank">
                          <p>dhuahdc@gmail.com</p>
                      </a>
                  </li>
              </ul>
          </div>
      </div>

      <div class="relative mt-5">
          <!-- Ikon Sosial Media -->
          <div class="flex justify-center md:justify-start gap-4 mb-4 md:absolute md:left-6 md:bottom-0">
              <a href="https://web.facebook.com/p/Dhuha-Mobilindo-100068821356785/?_rdc=1&_rdr#" target="_blank"
                  class="hover:opacity-60 transition">
                  <img src="{{ asset('img/fbp.png') }}"  alt="Facebook" class="h-8 w-auto">
              </a>
              <a href="https://www.instagram.com/dhuhagroup_id/" target="_blank" class="hover:opacity-60 transition">
                  <img src="{{ asset('img/igp.png') }}"  alt="Instagram" class="h-8 w-auto">
              </a>
              <a target="_blank" href="https://wa.me/+6285272201996" class="hover:opacity-60 transition">
                  <img src="{{ asset('img/wap.png') }}"  alt="WhatsApp" class="h-8 w-auto">
              </a>
          </div>
      </div>

  </footer>

  <!-- Bagian bawah footer   #f89331 -->
  <div class="bg-[#02104A] text-white py-[4px]">


      <!-- Copyright -->
      <div class="text-center text-sm opacity-80">
          © 2025 DRIVE NUSA ACADEMY. All rights reserved.
      </div>
  </div>
