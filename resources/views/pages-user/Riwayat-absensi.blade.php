@extends('components.layout-user')

@section('title', 'Riwayat Kehadiran')

@section('content')
<!-- Main Content -->
<main class="bg-gray-100 p-8">
    <div class="container mx-auto bg-white p-6 shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Riwayat Kehadiran</h1>
        
        <!-- Tombol Upload Foto Izin -->
        <div class="mt-4 sm:mt-0 mb-4">
            <label for="uploadIzin" class="bg-blue-500 text-white text-xs px-4 py-2 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out cursor-pointer">
                <i class="fas fa-upload mr-2"></i> Upload Foto Izin
            </label>
            <input type="file" id="uploadIzin" class="hidden" accept="image/*" onchange="uploadIzin(event)">
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
                <tbody class="text-gray-600 text-sm font-light" id="riwayatKehadiran">
                    <tr class="bg-white hover:bg-gray-50 transition duration-200 ease-in-out">
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">1</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800">Ahmad Zaki</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">2024-11-20</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">Izin</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">09:00</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">17:00</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center">
                            <img class="w-16 h-16 object-cover rounded-full mx-auto" src="https://via.placeholder.com/150" alt="Foto Izin">
                        </td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-full shadow-lg hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
                                <i class="fas fa-eye"></i> Lihat
                            </button>
                        </td>
                    </tr>
                    <tr class="bg-white hover:bg-gray-50 transition duration-200 ease-in-out">
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">2</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800">Lina Maulida</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">2024-11-19</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">Hadir</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">08:30</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">16:30</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center">-</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-full shadow-lg hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
                                <i class="fas fa-eye"></i> Lihat
                            </button>
                        </td>
                    </tr>
                    <tr class="bg-white hover:bg-gray-50 transition duration-200 ease-in-out">
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">3</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800">Rizki Fadillah</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">2024-11-18</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">Tidak Hadir</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">-</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">-</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center">-</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-full shadow-lg hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
                                <i class="fas fa-eye"></i> Lihat
                            </button>
                        </td>
                    </tr>
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

    <!-- Modal Untuk Melihat Foto -->
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" id="modal" onclick="closeModal()">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96" onclick="event.stopPropagation();">
            <h2 class="text-xl font-bold mb-4 flex justify-between items-center">
                Absen
                <span class="cursor-pointer text-black" onclick="closeModal()">×</span>
            </h2>
            <div class="flex justify-around">
                <div class="flex flex-col items-center">
                    <button class="text-black font-semibold px-4 py-2 hover:underline" id="checkInButton" onclick="showImage('checkIn')">
                        Masuk
                    </button>
                    <div class="border-b border-green-500 w-16 mt-1"></div>
                </div>
                <div class="flex flex-col items-center">
                    <button class="text-black font-semibold px-4 py-2 hover:underline" id="checkOutButton" onclick="showImage('checkOut')">
                        Pulang
                    </button>
                    <div class="border-b border-red-500 w-16 mt-1"></div>
                </div>
            </div>
            <div class="mt-4" id="checkInImage">
                <img alt="Check In" class="w-full h-auto rounded-lg shadow-md transition-transform transform hover:scale-105" src="https://storage.googleapis.com/a1aa/image/WztpJ9sAYAbAJtoJTVPK6Dzcc3JdredOr5FsatACWT5Auy0JA.jpg"/>
            </div>
            <div class="hidden mt-4" id="checkOutImage">
                <img alt="Check Out" class="w-full h-auto rounded-lg shadow-md transition-transform transform hover:scale-105" height="300" src="https://storage.googleapis.com/a1aa/image/g3oYLVfAcszXFincakeNQgd7iGD8hUjPaeNQJJXHBXvo6tbnA.jpg" width="300"/>
            </div>
        </div>
    </div>
</main>
<!-- Chart.js -->
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

</script>
@endsection
