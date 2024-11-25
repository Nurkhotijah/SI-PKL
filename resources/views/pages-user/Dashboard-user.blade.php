@extends('components.layout-user')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="flex-1 p-6 bg-gray-100">
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
      <div class="flex space-x-4">
          <a class="bg-blue-500 text-white px-4 py-2 rounded-lg" href="{{ route('jurnal-kegiatan') }}" id="isi-jurnal">
              Lihat Jurnal
          </a>
          <button class="bg-green-500 text-white px-4 py-2 rounded-lg" id="ayo-absen">
              Ayo Absen
          </button>
          <!-- Tombol Download Sertifikat -->
          <a class="bg-gray-800 text-white px-4 py-2 rounded-lg" 
             href="{{ asset('path/to/certificate.pdf') }}" 
             download="Sertifikat_PKL_{{ Auth::user()->name }}" 
             id="download-certificate">
              Download Sertifikat
          </a>
      </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
      <div class="bg-white p-6 rounded-lg shadow">
          <div class="flex items-center justify-between">
              <h2 class="text-lg font-semibold">
                  Waktu Saat Ini
              </h2>
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
</div>

   </div>
  </div>
  <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" id="cameraModal">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Kamera</h2>
            <button class="text-gray-600 hover:text-gray-800" id="closeButton">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <!-- Video element with Tailwind for size -->
        <video autoplay class="w-full h-auto bg-gray-200 rounded-lg" id="video"></video>
        <div class="flex justify-center mt-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2" id="captureButton">
                Ambil Foto
            </button>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg hidden" id="doneButton">
                Selesai
            </button>
        </div>
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    let sudahAbsenMasuk = false;

    // Update waktu setiap detik
    function updateTime() {
        const timeElement = document.getElementById('current-time');
        const now = new Date();
        timeElement.textContent = `${now.toLocaleTimeString('id-ID', { hour12: false })} WIB`;
    }
    setInterval(updateTime, 1000);
    updateTime();

   // Handle tombol "Ayo Absen"
const ayoAbsenButton = document.getElementById('ayo-absen');
ayoAbsenButton.addEventListener('click', function() {
    const cameraModal = document.getElementById('cameraModal');
    cameraModal.classList.remove('hidden');
    startVideo(); // Ganti startCamera() dengan startVideo()

    if (!sudahAbsenMasuk) {
        sudahAbsenMasuk = true;
        ayoAbsenButton.textContent = "Ayo Pulang";

        fetch('/absen/masuk', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('jumlah-laporan').textContent = data.jumlahLaporan;
        })
        .catch(error => console.error("Gagal absen masuk:", error));
    }
});

// Handle tombol selesai
document.getElementById('doneButton').addEventListener('click', function() {
    const cameraModal = document.getElementById('cameraModal');
    cameraModal.classList.add('hidden');
    stopCamera();

    if (sudahAbsenMasuk) {
        fetch('/absen/keluar', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        })
        .then(() => {
            ayoAbsenButton.textContent = "Ayo Absen";
            sudahAbsenMasuk = false;
        })
        .catch(error => console.error("Gagal absen keluar:", error));
    }
});
// Modal dan Video Handling
const video = document.getElementById('video');

// Fungsi untuk mulai menangkap video
function startVideo() {
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
        })
        .catch(err => console.error("Error akses kamera:", err));
}

// Fungsi untuk menghentikan kamera setelah foto diambil
function stopCamera() {
    const stream = video.srcObject;
    if (stream) {
        stream.getTracks().forEach(track => track.stop());
    }
    video.srcObject = null;
}

// Modal Kamera - Capture Foto
document.getElementById('captureButton').addEventListener('click', function() {
    const canvas = document.createElement('canvas');
    const context = canvas.getContext('2d');

    // Ambil ukuran tampilan video (clientWidth dan clientHeight)
    const videoWidth = video.clientWidth;
    const videoHeight = video.clientHeight;

    // Set canvas dengan ukuran video
    canvas.width = videoWidth;
    canvas.height = videoHeight;

    // Gambarkan video ke canvas
    context.drawImage(video, 0, 0, videoWidth, videoHeight);

    // Sembunyikan video dan ganti dengan canvas
    stopCamera();
    video.style.display = 'none';  // Sembunyikan video
    video.replaceWith(canvas);     // Ganti dengan canvas

        // Tampilkan tombol selesai dan sembunyikan tombol capture
        this.classList.add('hidden');
    document.getElementById('doneButton').classList.remove('hidden');
    sudahAbsenMasuk = true;  // Menandakan sudah absen masuk
});

// Handle tombol "Selesai"
document.getElementById('doneButton').addEventListener('click', function() {
    const cameraModal = document.getElementById('cameraModal');
    cameraModal.classList.add('hidden');
    stopCamera();

    // Jika sudah absen masuk, kirim permintaan absen keluar
    if (sudahAbsenMasuk) {
        fetch('/absen/keluar', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        })
        .then(() => {
            ayoAbsenButton.textContent = "Ayo Absen";
            sudahAbsenMasuk = false;
        })
        .catch(error => console.error("Gagal absen keluar:", error));
    }
});

// Close button untuk menutup modal
document.getElementById('closeButton').addEventListener('click', function() {
    const cameraModal = document.getElementById('cameraModal');
    cameraModal.classList.add('hidden');
    stopCamera();
});


// Reset tampilan modal dan foto
function resetAbsenModal() {
    const canvas = document.querySelector('canvas');
    if (canvas) {
        canvas.remove();  // Hapus canvas yang muncul sebelumnya
    }
    
    video.style.display = 'block';  // Tampilkan kembali video
    startVideo();  // Mulai video baru
    document.getElementById('captureButton').classList.remove('hidden');  // Tampilkan tombol capture
    document.getElementById('doneButton').classList.add('hidden');  // Sembunyikan tombol selesai
    sudahAbsenMasuk = false;  // Reset status absen masuk
}

// Fungsi untuk absen keluar
function absenKeluar() {
    resetAbsenModal();
    // Lakukan absen keluar
    fetch('/absen/keluar', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
    })
    .then(() => {
        ayoAbsenButton.textContent = "Ayo Absen";
    })
    .catch(error => console.error("Gagal absen keluar:", error));
}
// Cek status absen
function checkAbsenStatus() {
    fetch('/absen/status', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.absenSelesai) {
                ayoAbsenButton.setAttribute('disabled', true);
                ayoAbsenButton.classList.add('bg-gray-400', 'cursor-not-allowed');
            }
        })
        .catch(err => console.error("Error cek status absen:", err));
}

checkAbsenStatus();
});
</script>
  
  @endsection