  @auth
      {{-- TAMPILAN JIKA SUDAH LOGIN (Profile/Dropdown) --}}
      {{-- Hapus kelas 'group' karena kita akan menggunakan JS untuk klik --}}
      <div class="relative">

          {{-- Avatar atau Nama Pengguna (TRIGGER) --}}
          {{-- Tambahkan id untuk JS dan onClick --}}
          <button id="profile-dropdown-button" type="button"
              class="flex items-center text-gray-900 hover:text-blue-600 focus:outline-none transition duration-150 transform hover:-translate-y-0.5 py-2">

              {{-- Menggunakan Nama atau Avatar --}}
              <img class="h-8 w-8 rounded-full object-cover mr-2" src="{{ asset('img/logo2.png') }}"
                  alt="{{ Auth::user()->name }}">
              <span class="text-sm font-medium hidden lg:inline">{{ Auth::user()->name }}</span>

              {{-- Chevron Down Icon --}}
              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                  </path>
              </svg>
          </button>

          {{-- Dropdown Menu (KONTEN) --}}
          {{-- 2. DROP DOWN MENU --}}
          <div id="profile-dropdown-menu" {{-- Styling Dropdown --}}
              class="absolute right-0 mt-2 w-64 bg-[#342e48] rounded-md shadow-2xl py-0 z-50 hidden 
                   overflow-hidden border border-gray-700">

              {{-- A. HEADER PROFIL (Sesuai Gambar: Nama & Email) --}}
              <div class="flex items-center p-4 border-b border-gray-700  bg-white">
                  <img class="h-10 w-10 rounded-full object-cover mr-3" src="{{ asset('img/logo2.png') }}"
                      alt="{{ Auth::user()->name }}">

                  <div>
                      {{-- Nama Pengguna --}}
                      <p class="text-base font-semibold">{{ Auth::user()->name ?? 'Pengguna' }}</p>
                      {{-- Email Pengguna --}}
                      <p class="text-xs text-gray-400 font-light">
                          {{ Auth::user()->email ?? 'user@example.com' }}</p>
                  </div>
              </div>

              {{-- B. LIST MENU (Sesuai Gambar) --}}
              <div class="py-2">

                  {{-- My Profile --}}
                  <a href="{{ route('profile.show') }}"
                      class="block px-4 py-3 text-sm hover:bg-[#ffffff] transition duration-100">
                      My Profile
                  </a>

                  {{-- Settings --}}
                  <a href="/settings" class="block px-4 py-3 text-sm hover:bg-[#ffffff] transition duration-100">
                      Settings
                  </a>

                  {{-- Billing --}}
                  <a href="/billing" class="block px-4 py-3 text-sm hover:bg-[#ffffff] transition duration-100">
                      Billing
                  </a>

                  {{-- FAQs --}}
                  <a href="/faqs" class="block px-4 py-3 text-sm hover:bg-[#ffffff] transition duration-100">
                      FAQs
                  </a>
              </div>

              {{-- C. FOOTER (Logout) --}}
              <div class="border-t border-gray-700">
                  <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit"
                          class="block w-full text-left px-4 py-3 text-sm hover:bg-[#ffffff] transition duration-100">
                          Logout
                      </button>
                  </form>
              </div>

          </div>
      </div>
  @endauth
