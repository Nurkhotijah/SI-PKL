@extends('components.layout-user')

@section('title', 'Riwayat Kehadiran')

@section('content')
<!-- Main Content -->
<main class="bg-gray-100 p-8">
    <div class="container mx-auto bg-white p-6 shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Riwayat Kehadiran</h1>
       <!-- Tombol Upload Foto Izin -->
<div class="mt-4 sm:mt-0 mb-4 flex items-center space-x-4">
    <!-- Tombol Upload Foto Izin -->
    <form action="{{ route('uploadFotoIzin') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="uploadIzin" class="bg-blue-500 text-white text-xs px-6 py-3 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out cursor-pointer flex items-center w-auto">
            <i class="fas fa-upload mr-2"></i> Upload Foto Izin
        </label>
        <input type="file" id="uploadIzin" name="foto_izin" class="hidden" accept="image/jpeg, image/png" required>
        <button type="submit" class="hidden">Submit</button>
    </form>

    <!-- Tombol Unduh Rekap Kehadiran -->
    <a class="bg-green-500 text-white text-xs px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300 ease-in-out flex items-center space-x-2 w-auto" 
       href="{{ asset('path/to/certificate.pdf') }}" 
       download="Sertifikat_PKL_{{ Auth::user()->name }}">
        <i class="fas fa-download"></i>
        <span>Rekap Kehadiran</span>
    </a>
</div>

<!-- Tabel Riwayat Kehadiran -->
<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
        <thead class="bg-gray-200">
            <tr class="text-gray-600 text-sm">
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">No</th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Nama Lengkap</th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Tanggal</th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Status Kehadiran</th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Waktu Masuk</th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Waktu Keluar</th>
                <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Foto Izin</th>
                <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($kehadiran as $item)
            <tr class="bg-white hover:bg-gray-50 transition duration-200 ease-in-out">
                <td class="py-4 px-4 border-b border-gray-300 text-gray-700">{{ $loop->iteration }}</td>
                <td class="py-4 px-4 border-b border-gray-300 text-gray-800">{{ $item->name }}</td>
                <td class="py-4 px-4 border-b border-gray-300 text-gray-600">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                <td class="py-4 px-4 border-b border-gray-300 text-gray-600">{{ $item->status_kehadiran }}</td>
                <td class="py-4 px-4 border-b border-gray-300 text-gray-600">{{ \Carbon\Carbon::parse($item->waktu_masuk)->format('H:i') }}</td>
                <td class="py-4 px-4 border-b border-gray-300 text-gray-600">{{ \Carbon\Carbon::parse($item->waktu_keluar)->format('H:i') }}</td>
                <td class="py-4 px-4 border-b border-gray-300 text-center">
                    @if($item->foto_izin)
                    <img class="w-16 h-16 object-cover rounded-full mx-auto" src="{{ asset('storage/foto_izin/' . $item->foto_izin) }}" alt="Foto Izin">
                    @else
                    Tidak ada foto
                    @endif
                </td>
                <td class="py-4 px-4 border-b border-gray-300 text-center">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-full shadow-lg hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
                        <i class="fas fa-eye"></i> Lihat
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

        
        <!-- Pagination -->
        <div class="flex justify-end items-center mt-4">
            <span class="mr-4" id="pageNumber">Halaman 1</span>
            <button class="bg-gray-300 text-gray-700 p-2 rounded mr-2" onclick="prevPage()">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="bg-gray-300 text-gray-700 p-2 rounded" onclick="nextPage()">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

    @foreach($kehadiran as $item)
    <!-- Modal untuk Foto Absen Masuk dan Keluar -->
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" id="modal-{{ $item->id }}" onclick="closeModal({{ $item->id }})">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96" onclick="event.stopPropagation();">
            <h2 class="text-xl font-bold mb-4 flex justify-between items-center">
                Lihat Foto Kehadiran
                <span class="cursor-pointer text-black" onclick="closeModal({{ $item->id }})">×</span>
            </h2>
            <div class="flex justify-around">
                <div class="flex flex-col items-center">
                    <button class="text-black font-semibold px-4 py-2 hover:underline" id="checkInButton-{{ $item->id }}" onclick="showImage('checkIn', {{ $item->id }})">
                        Masuk
                    </button>
                    <div class="border-b border-green-500 w-16 mt-1"></div>
                </div>
                <div class="flex flex-col items-center">
                    <button class="text-black font-semibold px-4 py-2 hover:underline" id="checkOutButton-{{ $item->id }}" onclick="showImage('checkOut', {{ $item->id }})">
                        Pulang
                    </button>
                    <div class="border-b border-red-500 w-16 mt-1"></div>
                </div>
            </div>
            <div class="mt-4 hidden" id="checkInImage-{{ $item->id }}">
                <img alt="Absen Masuk" class="w-full h-auto rounded-lg shadow-md transition-transform transform hover:scale-105" src="{{ asset('storage/'.$item->foto_masuk) }}"/>
            </div>
            <div class="hidden mt-4" id="checkOutImage-{{ $item->id }}">
                <img alt="Absen Keluar" class="w-full h-auto rounded-lg shadow-md transition-transform transform hover:scale-105" src="{{ asset('storage/'.$item->foto_keluar) }}"/>
            </div>
        </div>
    </div>
    @endforeach
    
</main>
{{-- <!-- Chart.js -->
<script>
        // Simulasi upload foto izin
        function uploadIzin(event) {
        const file = event.target.files[0];
        if (file) {
            // Menampilkan foto yang diupload
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageUrl = e.target.result;

                // Menambahkan baris baru di tabel
                const tableBody = document.getElementById('riwayatKehadiran');
                const newRow = document.createElement('tr');
                newRow.classList.add('bg-white', 'hover:bg-gray-50', 'transition', 'duration-200', 'ease-in-out');

                newRow.innerHTML = `
                    <td class="py-4 px-4 border-b border-gray-300 text-gray-700">1</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-gray-800">Nur Khotijah</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-gray-600">2024-10-02</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-gray-600">Izin</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-gray-600">-</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-gray-600">-</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-center">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-full shadow-lg hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
                            <i class="fas fa-eye"></i> Lihat
                        </button>
                    </td>
                    <td class="py-4 px-4 border-b border-gray-300 text-center">
                        <img class="w-16 h-16 object-cover rounded-full mx-auto" src="${imageUrl}" alt="Foto Izin">
                    </td>
                `;
                tableBody.appendChild(newRow);
            };
            reader.readAsDataURL(file);
        }
    }
    let currentPage = 1; // Halaman saat ini
const rowsPerPage = 10; // Jumlah data per halaman

// Fungsi untuk menampilkan data berdasarkan halaman
function displayTableData(page) {
    const table = document.getElementById("izinTable").getElementsByTagName("tbody")[0];
    const rows = table.getElementsByTagName("tr");

    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    for (let i = 0; i < rows.length; i++) {
        rows[i].style.display = i >= start && i < end ? "" : "none";
    }
    document.getElementById("pageNumber").textContent = `Halaman ${page}`;
}

// Paginasi - tombol berikutnya
function nextPage() {
    const table = document.getElementById("izinTable").getElementsByTagName("tbody")[0];
    const rows = table.getElementsByTagName("tr");

    if (currentPage * rowsPerPage < rows.length) {
        currentPage++;
        displayTableData(currentPage);
    }
}

// Paginasi - tombol sebelumnya
function prevPage() {
    if (currentPage > 1) {
        currentPage--;
        displayTableData(currentPage);
    }
}

// Inisialisasi tabel untuk halaman pertama
displayTableData(currentPage);

function openModal() {
            document.getElementById('modal').classList.remove('hidden');
            // Show Check In image by default
            showImage('checkIn');
        }

        // Close modal
        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
            document.getElementById('checkInImage').classList.remove('hidden');
            document.getElementById('checkOutImage').classList.add('hidden');
        }

        // Show selected image
        function showImage(type) {
            if (type === 'checkIn') {
                document.getElementById('checkInImage').classList.remove('hidden');
                document.getElementById('checkOutImage').classList.add('hidden');
            } else if (type === 'checkOut') {
                document.getElementById('checkOutImage').classList.remove('hidden');
                document.getElementById('checkInImage').classList.add('hidden');
            }
        }

        // Close modal if clicked outside
        window.addEventListener('click', function (e) {
            if (document.getElementById('modal').contains(e.target)) {
                closeModal();
            }
        });

    // Dropdown Functionality
    const profileButton = document.getElementById('profileButton');
    const profileDropdown = document.getElementById('profileDropdown');

    profileButton.addEventListener('click', () => {
        profileDropdown.classList.toggle('hidden');
    });

   
    // Close dropdown if clicked outside
    window.addEventListener('click', function (e) {
    if (!profileButton.contains(e.target) && !profileDropdown.contains(e.target)) {
        profileDropdown.classList.add('hidden');
    }
});

</script> --}}
@endsection
