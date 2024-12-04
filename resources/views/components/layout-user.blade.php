
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'default title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('assets/logo absensipkl.png') }}" type="image/x-icon"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-white min-h-screen">
  <div class="flex h-screen">
   <!-- Sidebar -->
   <div class=" w-64 md:w-1/6 bg-gray-800 text-white flex flex-col shadow-lg fixed md:relative top-0 h-full md:h-screen hidden md:block" id="sidebar">
    <div class="flex items-center justify-center p-3 text-lg font-bold border-b border-gray-700">
     <img alt="profile" class="rounded-full w-12 h-12 border-2 border-gray-400 mr-4" src="{{ asset('assets/SI-PKL.png') }}" />
     <span>
      SI-PKL
     </span>
    </div>
    <div class="mt-4 flex-grow">
      <ul>
        <!-- Dashboard -->
        <li class="p-3 {{ request()->is('pages-user/dashboard-user') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
            <img width="30" height="30" src="https://img.icons8.com/material-outlined/24/FFFFFF/home--v2.png" alt="home--v2"/>
            <a href="{{ route('user.dashboard') }}" class="text-sm">Dashboard</a>
        </li>
        <!-- Riwayat Kehadiran -->
        <li class="p-3 {{ request()->is('riwayat-absensi') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
            <img width="30" height="30" src="https://img.icons8.com/ios/50/FFFFFF/attendance-mark.png" alt="attendance-mark"/>
            <a href="{{ route('riwayat-absensi') }}" class="text-sm">Riwayat Kehadiran</a>
        </li>
        <!-- Jurnal Kegiatan Harian -->
<<<<<<< HEAD
        <li class="p-3 {{ request()->is('jurnal-kegiatan') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
            <img width="30" height="30" src="https://img.icons8.com/ios/50/FFFFFF/book--v1.png" alt="book--v1"/>
            <a href="{{ route('jurnal-kegiatan') }}" class="text-sm">Jurnal Kegiatan Harian</a>
=======
        <li class="p-3 {{ request()->is('jurnal-siswa') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
            <img width="30" height="30" src="https://img.icons8.com/ios/50/FFFFFF/book--v1.png" alt="book--v1"/>
            <a href="{{ route('jurnal-siswa.index') }}" class="text-sm">Jurnal Kegiatan Harian</a>
>>>>>>> 402795bc6af553ab04d2b300b5defc5eaeefa3d4
        </li>
        {{-- <!-- Pengajuan Izin/Cuti -->
        <li class="p-3 {{ request()->is('pengajuan-izin') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
            <img width="30" height="30" src="https://img.icons8.com/ios/50/FFFFFF/submit-document.png" alt="submit-document"/>
            <a href="{{ route('pengajuan-izin') }}" class="text-sm">Pengajuan Izin</a>
        </li> --}}
        {{-- <li class="p-3 {{ request()->is('penilaian-pkl') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
            <img width="30" height="30" src="https://img.icons8.com/ios/50/FFFFFF/permanent-job.png" alt="permanent-job"/>
            <a href="{{ route('penilaian-pkl') }}" class="text-sm">Penilaian PKL</a>
        </li>
        <li class="p-3 {{ request()->is('rekap-kehadiran') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
            <img width="30" height="30" src="https://img.icons8.com/ios/50/FFFFFF/test-results.png" alt="test-results"/>
            <a href="{{ route('rekap-kehadiran') }}" class="text-sm">Rekap Kehadiran</a>
        </li> --}}
    </ul>
    </div>
   </div>
   <div class="flex-1 flex flex-col overflow-auto">
    <nav class="bg-white p-4 text-white flex items-center justify-between border-b border-white shadow-lg sticky top-0 z-10 w-full">
     <div class="flex items-center space-x-4">
      <button class="text-gray-800 focus:outline-none md:hidden" id="menuButton">
       <i class="fas fa-bars">
       </i>
      </button>
     </div>
     <div class="flex items-center space-x-6 ml-auto">
      <div class="text-gray-800 font-bold text-base">
        {{ Auth::user()->name }}
      </div>
      <!-- Profil dan Dropdown -->
      <div class="relative">
        <button class="focus:outline-none flex items-center space-x-2" id="profileButton">
            <img src="{{ asset('assets/fitri.jpg') }}" alt="profile" class="w-auto h-8 rounded-full"/>
            <i class="fas fa-chevron-down text-gray-800"></i>
        </button>        
       <!-- Dropdown profile -->
       <div class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-lg hidden transition-all ease-in-out duration-150" id="profileDropdown">
        <ul class="py-1 text-gray-700">
         <li class="block px-4 py-2 hover:bg-gray-100 cursor-pointer transition">
          <a class="flex items-center space-x-2" href="{{ route('profile') }}">
           <img alt="test-account" height="30" src="https://img.icons8.com/fluency-systems-filled/50/000000/test-account.png" width="30"/>
           <span>
            Profile
           </span>
          </a>
         </li>
         <li id="logout" class="block px-4 py-2 hover:bg-gray-100 cursor-pointer transition">
            <a class="flex items-center space-x-2">
              <img alt="logout-rounded-left" height="30" src="https://img.icons8.com/ios-filled/50/000000/logout-rounded-left.png" width="30"/>
             <span>
              Logout
             </span>
            </a>
           </li>
        </ul>
       </div>
      </div>
     </div>
    </nav>

    <!-- Popup Logout Confirmation -->
      <div id="confirmationLogout" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-800 bg-opacity-50 text-sm md:text-lg">
        <div class="bg-white py-6 px-12 rounded-lg shadow-lg">
            <p class="text-center text-gray-700">Yakin mau logout?</p>
            <div class="mt-4 flex justify-center gap-6">
                <button id="cancelLogout" class="bg-white text-green-500 border border-green-500 py-2 px-4 rounded-xl hover:bg-green-500 hover:text-white">Tidak</button>
                <button id="confirmLogout" class="bg-white border border-red-500 text-red-500 py-2 px-4 rounded-xl hover:bg-red-500 hover:text-white">Ya</button>
            </div>
        </div>
    </div>

    <div class="flex-1 p-6 overflow-auto bg-gray-100">
        @yield('content')
    </div>
   </div>

<script>
    // Menampilkan popup saat tombol logout diklik
  document.getElementById('logout').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('confirmationLogout').classList.remove('hidden');
    });

    // Mengonfirmasi logout dan redirect ke halaman lain
    document.getElementById('confirmLogout').addEventListener('click', function() {
        document.getElementById('confirmationLogout').classList.add('hidden');
        window.location.href = '/'; // Ganti '/' dengan URL halaman tujuan setelah logout
    });

    // Membatalkan logout dan menutup popup
    document.getElementById('cancelLogout').addEventListener('click', function() {
        document.getElementById('confirmationLogout').classList.add('hidden');
    });


    // Dropdown Functionality
  const profileButton = document.getElementById('profileButton');
  const profileDropdown = document.getElementById('profileDropdown');
  profileButton.addEventListener('click', () => {
   profileDropdown.classList.toggle('hidden');
  });
  // Close dropdown if clicked outside
  window.addEventListener('click', function(e) {
   if (!profileButton.contains(e.target) && !profileDropdown.contains(e.target)) {
    profileDropdown.classList.add('hidden');
   }
  });
</script>
</body>