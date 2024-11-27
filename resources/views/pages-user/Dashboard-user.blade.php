@extends('components.layout-user')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="flex-1 p-6 bg-gray-100">
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-2">
            Hai {{ Auth::user()->name }}
            <span class="ml-2">
                <i class="fas fa-star text-yellow-500"></i>
            </span>
        </h1>
        <p class="text-lg font-semibold mb-1">Selamat Datang di Website Absensi PKL</p>
        <div class="flex space-x-4">
            <a class="bg-blue-500 text-white px-4 py-2 rounded-lg" href="{{ route('jurnal-kegiatan') }}">Lihat Jurnal</a>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg" id="ayo-absen">Ayo Absen</button>
            <a class="bg-gray-800 text-white px-4 py-2 rounded-lg" 
               href="{{ asset('path/to/certificate.pdf') }}" 
               download="Sertifikat_PKL_{{ Auth::user()->name }}">Download Sertifikat</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <!-- Waktu Saat Ini -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Waktu Saat Ini</h2>
            <p class="text-3xl font-bold mt-4" id="current-time">--:--:-- WIB</p>
        </div>

        <!-- Jumlah Laporan -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Jumlah Laporan PKL</h2>
            <p class="text-3xl font-bold mt-4" id="jumlah-laporan">0</p>
        </div>

        <!-- Jumlah Absen -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Jumlah Absen yang Telah Dilakukan</h2>
            <p class="text-3xl font-bold mt-4" id="jumlah-absen">0</p>
        </div>
    </div>
</div>

<!-- Modal Kamera -->
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" id="cameraModal">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Kamera</h2>
            <button class="text-gray-600 hover:text-gray-800" id="closeButton"><i class="fas fa-times"></i></button>
        </div>
        <video autoplay class="w-full h-auto bg-gray-200 rounded-lg" id="video"></video>
        <!-- Tempat Menampilkan Gambar Setelah Foto diambil -->
        <img id="captured-image" class="hidden mt-4 w-full h-auto bg-gray-200 rounded-lg" />
        <div class="flex justify-center mt-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2" id="captureButton">Ambil Foto</button>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg hidden" id="doneButton">Selesai</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ayoAbsenButton = document.getElementById('ayo-absen');
    const cameraModal = document.getElementById('cameraModal');
    const video = document.getElementById('video');
    const captureButton = document.getElementById('captureButton');
    const doneButton = document.getElementById('doneButton');
    const closeButton = document.getElementById('closeButton');
    const capturedImage = document.getElementById('captured-image');
    let sudahAbsenMasuk = false;
    let sudahAbsenPulang = false;
    let photoDataUrl = null; // Tempat menyimpan foto

    // Update waktu setiap detik
    function updateTime() {
        const timeElement = document.getElementById('current-time');
        const now = new Date();
        timeElement.textContent = `${now.toLocaleTimeString('id-ID', { hour12: false })} WIB`;
    }
    setInterval(updateTime, 1000);

    // Fungsi untuk memulai video kamera
    function startVideo() {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(error => {
                console.error('Gagal mengakses kamera:', error);
                alert('Gagal mengakses kamera. Pastikan izin kamera diaktifkan.');
            });
    }

    // Fungsi untuk menghentikan kamera
    function stopCamera() {
        const stream = video.srcObject;
        if (stream) {
            const tracks = stream.getTracks();
            tracks.forEach(track => track.stop());
            video.srcObject = null;
        }
    }

    // Fungsi membuka modal kamera
    function openModal() {
        cameraModal.classList.remove('hidden');
        startVideo();
    }

    // Fungsi menutup modal kamera
    function closeModal() {
        cameraModal.classList.add('hidden');
        stopCamera();
    }

    // Fungsi mengambil foto
    function capturePhoto() {
        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        return canvas.toDataURL('image/png'); // Mengubah foto ke format base64
    }

    // Event listener untuk tombol "Ayo Absen"
    ayoAbsenButton.addEventListener('click', function () {
        if (!sudahAbsenMasuk) {
            openModal(); // Buka modal untuk absen masuk
        } else if (!sudahAbsenPulang) {
            openModal(); // Buka modal untuk absen pulang
        } else {
            alert('Anda sudah melakukan absen masuk dan pulang hari ini!');
        }
    });

    // Event listener untuk tombol "Ambil Foto"
    captureButton.addEventListener('click', function () {
        photoDataUrl = capturePhoto(); // Menyimpan foto dalam format base64
        console.log('Foto diambil:', photoDataUrl); // Simulasi pengiriman ke server

        // Tampilkan gambar yang diambil
        capturedImage.src = photoDataUrl;
        capturedImage.classList.remove('hidden'); // Menampilkan gambar

        // Hentikan video setelah foto diambil
        stopCamera();

        // Sembunyikan tombol "Ambil Foto" dan tampilkan tombol "Selesai"
        captureButton.classList.add('hidden');
        doneButton.classList.remove('hidden');
    });

    // Event listener untuk tombol "Selesai"
    doneButton.addEventListener('click', function () {
        closeModal();

        if (!sudahAbsenMasuk) {
            sudahAbsenMasuk = true;
            ayoAbsenButton.textContent = 'Ayo Pulang';
        } else if (!sudahAbsenPulang) {
            sudahAbsenPulang = true;
            ayoAbsenButton.textContent = 'Sudah Absen';
            ayoAbsenButton.disabled = true;
            ayoAbsenButton.classList.add('bg-gray-500', 'cursor-not-allowed');
            ayoAbsenButton.classList.remove('bg-green-500');
        }

        // Kirim foto ke server menggunakan fetch atau simpan di database
        if (photoDataUrl) {
            fetch('/path/to/save-photo', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ photo: photoDataUrl })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Foto berhasil disimpan:', data);
            })
            .catch(error => {
                console.error('Gagal menyimpan foto:', error);
            });
        }
    });

    // Event listener untuk tombol "Tutup Modal"
    closeButton.addEventListener('click', closeModal);
});
</script>
@endsection
