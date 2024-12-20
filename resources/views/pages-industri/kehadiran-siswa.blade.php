@extends('components.layout-industri')

@section('title', 'Data rekap Siswa')

@section('content')

<main class="bg-gray-100">
    <div class="p-6 overflow-y-auto h-full">
        <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
            <!-- Header Section -->
            <div class="mb-4">
                <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Rekap Siswa</h1>
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0 sm:space-x-4">
                    <div class="relative w-full sm:w-auto">
                        <input class="border rounded p-2 pl-10 w-full sm:w-64" id="search" placeholder="Cari Nama atau sekolah" type="text" oninput="searchTable()">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>

                        <!-- Tombol Tambah di sebelah kanan Search Bar -->
                        <a href="{{ route('tambah-rekap', 1) }}" class="bg-green-500 text-white text-xs px-4 py-2 rounded-r shadow hover:bg-green-600 transition duration-300 ease-in-out ml-2">
                            <i class="fas fa-plus mr-2"></i> Tambah
                        </a>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border" id="attendanceTable">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b text-center">No</th>
                            <th class="py-2 px-4 border-b text-left">Nama Lengkap</th>
                            <th class="py-2 px-4 border-b text-left">Sekolah</th>
                            <th class="py-2 px-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b text-center">1</td>
                            <td class="py-2 px-4 border-b text-left">Fitri Amaliah</td>
                            <td class="py-2 px-4 border-b text-left">SMKN 1 Ciomas</td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('edit-rekap', 1) }}" class="bg-yellow-400 text-white text-xs px-3 py-1 shadow hover:bg-yellow-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <a href="{{ route('lihat-rekap', 2) }}" target="_blank" class="bg-blue-400 text-white text-xs px-3 py-1 shadow hover:bg-blue-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-eye mr-1"></i> Lihat
                                    </a>                                    
                                    <a href="{{ route('cetak-rekap', 1) }}" target="_blank" class="bg-green-400 text-white text-xs px-3 py-1 shadow hover:bg-green-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-print mr-1"></i> Cetak
                                    </a>
                                    <button onclick="openDeleteModal(this)" class="bg-red-400 text-white text-xs px-3 py-1 shadow hover:bg-red-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </button>
                                </div>                   
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b text-center">2</td>
                            <td class="py-2 px-4 border-b text-left">Marsya</td>
                            <td class="py-2 px-4 border-b text-left">SMK Komputer Indonesia</td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('edit-rekap', 1) }}" class="bg-yellow-400 text-white text-xs px-3 py-1 shadow hover:bg-yellow-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <a href="{{ route('lihat-rekap', 2) }}" target="_blank" class="bg-blue-400 text-white text-xs px-3 py-1 shadow hover:bg-blue-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-eye mr-1"></i> Lihat
                                    </a>                                    
                                    <a href="{{ route('cetak-rekap', 1) }}" target="_blank" class="bg-green-400 text-white text-xs px-3 py-1 shadow hover:bg-green-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-print mr-1"></i> Cetak
                                    </a>
                                    <button onclick="openDeleteModal(this)" class="bg-red-400 text-white text-xs px-3 py-1 shadow hover:bg-red-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </button>
                                </div> 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Section -->
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
</main>

<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
        <h2 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h2>
        <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
        <div class="flex justify-end space-x-3">
            <button onclick="closeDeleteModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                Batal
            </button>
            <button onclick="deleteRow()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Hapus
            </button>
        </div>
    </div>
</div>

   
    <script>
        let deleteModal = document.getElementById('deleteModal');
let rowToDelete = null;

function openDeleteModal(button) {
    rowToDelete = button.closest('tr'); // Simpan baris yang akan dihapus
    deleteModal.classList.remove('hidden'); // Tampilkan modal
}

function closeDeleteModal() {
    deleteModal.classList.add('hidden'); // Sembunyikan modal
    rowToDelete = null; // Reset baris yang akan dihapus
}

function deleteRow() {
    if (rowToDelete) {
        rowToDelete.remove(); // Hapus baris dari tabel
        closeDeleteModal(); // Tutup modal
    }
}

      
        let currentPage = 1; // Halaman saat ini
        const rowsPerPage = 10; // Jumlah data per halaman

        // Fungsi untuk menampilkan data berdasarkan halaman
        function displayTableData(page) {
            const table = document.getElementById("attendanceTable").getElementsByTagName("tbody")[0];
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
            const table = document.getElementById("attendanceTable").getElementsByTagName("tbody")[0];
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

        function searchTable() {
            const searchValue = document.getElementById("search").value.toLowerCase();
            const rows = document.querySelectorAll("#attendanceTable tbody tr");
            rows.forEach(row => {
                const name = row.children[1].textContent.toLowerCase();
                const school = row.children[2].textContent.toLowerCase();
                if (name.includes(searchValue) || school.includes(searchValue)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        window.onload = function() {
            populateSchoolDropdown();
        };

        function populateSchoolDropdown() {
            const rows = document.querySelectorAll("#attendanceTable tbody tr");
            const schoolDropdown = document.getElementById("school");

            const schools = new Set(); // Using a Set to ensure no duplicates

            rows.forEach(row => {
                const school = row.children[2].textContent.trim(); // Get the school name
                schools.add(school); // Add school to the Set (duplicates will be ignored)
            });

            // Clear the dropdown before adding new options
            schoolDropdown.innerHTML = '<option value="">Pilih Sekolah</option>'; 

            // Add the schools to the dropdown
            schools.forEach(school => {
                const option = document.createElement("option");
                option.value = school.toLowerCase().replace(/\s+/g, '_'); // Convert school name to a suitable format for value
                option.textContent = school;
                schoolDropdown.appendChild(option);
            });
        }

        function filterBySchool() {
            const school = document.getElementById("school").value.toLowerCase();
            const rows = document.querySelectorAll("#attendanceTable tbody tr");

            rows.forEach(row => {
                const rowSchool = row.children[2].textContent.toLowerCase().replace(/\s+/g, '_');
                if (school === "" || rowSchool.includes(school)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    </script>
@endsection