@extends('components.layout-industri')

@section('title', 'Dashboard Industri')

@section('content')
<body class="flex-1 p-6 bg-gray-100">
  <div class="bg-white p-4 rounded-lg shadow-md">
    <!-- Ini adalah kotak utama yang berisi konten -->
    <h1 class="text-2xl font-bold mb-2">
      Hai {{ Auth::user()->name }}
      <span class="ml-2">
        <i class="fas fa-star text-yellow-500"></i>
      </span>
    </h1>
    <p class="text-lg font-semibold mb-1">
      Selamat Datang Di Website Absensi PKL
    </p>
    <p class="text-gray-600 mb-4"></p>

    <!-- Tombol Tambah Akun di dalam kotak Selamat Datang -->
    <div class="mt-4">
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
    <div class="bg-white p-6 rounded-lg shadow">
      <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold">Waktu Saat Ini</h2>
        <i class="fas fa-clock text-purple-500 text-3xl"></i>
      </div>
      <p class="text-3xl font-bold mt-4" id="current-time">
        15.21.19 WIB
      </p>
      <p class="text-gray-600">
        Jam yang menunjukkan waktu saat ini secara real-time.
      </p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
      <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold">
          Jumlah Laporan PKL
        </h2>
        <i class="fas fa-file-alt text-blue-500 text-3xl"></i>
      </div>
      <p class="text-3xl font-bold mt-4" id="jumlah-laporan">
        0
      </p>
      <p class="text-gray-600">
        Jumlah total laporan PKL yang sudah dikirim oleh siswa.
      </p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
      <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold">
          Jumlah Absen yang telah dilakukan
        </h2>
        <i class="fas fa-check text-green-500 text-3xl"></i>
      </div>
      <p class="text-3xl font-bold mt-4" id="jumlah-absen">
        0
      </p>
      <p class="text-gray-600">
        Jumlah absensi yang telah dilakukan oleh Anda.
      </p>
    </div>
  </div>

  <!-- Modal Pop-up -->
  <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
      <h2 class="text-xl font-semibold mb-4">Tambah Akun Siswa</h2>
      <form action="#" method="POST">
        <div class="mb-4">
          <label for="email" class="block text-sm font-semibold mb-2">Email</label>
          <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded-lg" required />
        </div>
        <div class="mb-4">
          <label for="password" class="block text-sm font-semibold mb-2">Password</label>
          <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded-lg" required />
        </div>
        <div class="flex justify-end">
          <button type="submit" class="bg-green-500 text-white p-2 rounded-lg hover:bg-green-600">
            Simpan
          </button>
        </div>
      </form>
      <button onclick="toggleModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
</body>


<script>
   // Fungsi untuk menampilkan/memblokir modal
   function toggleModal() {
      const modal = document.getElementById("modal");
      modal.classList.toggle("hidden");
    }
  // Fungsi untuk memperbarui waktu setiap detik
  function updateTime() {
    const currentTimeElement = document.getElementById("current-time");
    const currentDate = new Date();

    // Format waktu dalam HH:mm:ss
    const hours = currentDate.getHours().toString().padStart(2, '0');
    const minutes = currentDate.getMinutes().toString().padStart(2, '0');
    const seconds = currentDate.getSeconds().toString().padStart(2, '0');

    const timeString = `${hours}:${minutes}:${seconds} WIB`;

    // Memperbarui elemen dengan ID 'current-time'
    currentTimeElement.textContent = timeString;
  }

  // Panggil fungsi updateTime setiap detik
  setInterval(updateTime, 1000);
</script>

@endsection
