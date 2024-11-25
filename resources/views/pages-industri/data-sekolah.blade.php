@extends('components.layout-industri')

@section('title', 'Data Sekolah')

@section('content')
<div class="bg-gray-100">
    <main class="p-6 overflow-y-auto h-full">
        <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
            <!-- Header Section -->
            <div class="mb-4">
                <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Kelola Data Sekolah</h1>
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0 sm:space-x-4">
                    <div class="relative w-full sm:w-auto">
                        <input class="border rounded p-2 pl-10 w-full sm:w-64" id="search" placeholder="Cari Nama Sekolah" type="text" oninput="searchTable()">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <div class="flex items-center w-full sm:w-auto sm:ml-auto">
                        <label class="mr-2" for="school">Pilih Sekolah:</label>
                        <select class="border rounded p-2 w-full sm:w-auto" id="school" onchange="filterBySchool()">
                            <option value="">Pilih Sekolah</option>
                            <option value="smkn_1_ciomas">SMKN 1 Ciomas</option>
                            <option value="smk_komputer_indonesia">SMK Komputer Indonesia</option>
                            <option value="smk_adi_sanggoro">SMK Adi Sanggoro</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border" id="schoolTable">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b text-center">No</th>
                            <th class="py-2 px-4 border-b text-left">Nama Sekolah</th>
                            <th class="py-2 px-4 border-b text-left">Email Sekolah</th>
                            <th class="py-2 px-4 border-b text-left">Alamat Sekolah</th>
                            <th class="py-2 px-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example rows for schools -->
                        <tr class="school-row" data-school="smkn_1_ciomas">
                            <td class="py-2 px-4 border-b text-center">1</td>
                            <td class="py-2 px-4 border-b text-left">SMKN 1 Ciomas</td>
                            <td class="py-2 px-4 border-b text-left">ciomas@smkn1.sch.id</td>
                            <td class="py-2 px-4 border-b text-left">Jl. Raya Ciomas No.1</td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="window.open('{{ route('lihat-siswa', 2) }}', '_blank')" class="bg-yellow-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-yellow-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-eye mr-1"></i> Lihat
                                    </button>                                    
                                    <button onclick="deleteSchool(1)" class="bg-red-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-red-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="school-row" data-school="smk_komputer_indonesia">
                            <td class="py-2 px-4 border-b text-center">2</td>
                            <td class="py-2 px-4 border-b text-left">SMK Komputer Indonesia</td>
                            <td class="py-2 px-4 border-b text-left">info@smkkomputer.sch.id</td>
                            <td class="py-2 px-4 border-b text-left">Jl. Teknologi No.15</td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="viewStudents('smk_komputer_indonesia')" class="bg-yellow-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-yellow-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-eye mr-1"></i> Lihat
                                    </button>
                                    <button onclick="deleteSchool(2)" class="bg-red-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-red-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="school-row" data-school="smk_adi_sanggoro">
                            <td class="py-2 px-4 border-b text-center">3</td>
                            <td class="py-2 px-4 border-b text-left">SMK Adi Sanggoro</td>
                            <td class="py-2 px-4 border-b text-left">admin@adisanggoro.sch.id</td>
                            <td class="py-2 px-4 border-b text-left">Jl. Adi No.30</td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="viewStudents('smk_adi_sanggoro')" class="bg-yellow-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-yellow-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-eye mr-1"></i> Lihat
                                    </button>
                                    <button onclick="deleteSchool(3)" class="bg-red-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-red-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-trash mr-1"></i> Hapus
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
</div>

<script>
    // Function to handle searching in the table
    function searchTable() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const rows = document.querySelectorAll('.school-row');
        rows.forEach(row => {
            const schoolName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            if (schoolName.includes(searchInput)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Function to filter by selected school (optional for future feature)
    function filterBySchool() {
        const selectedSchool = document.getElementById('school').value;
        const rows = document.querySelectorAll('.school-row');
        rows.forEach(row => {
            const school = row.getAttribute('data-school');
            if (selectedSchool === '' || school === selectedSchool) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Function to view students for a selected school
    function viewStudents(school) {
        alert(`Menampilkan siswa untuk sekolah: ${school}`);
        // Here you would redirect to another page or load student data dynamically
    }

    // Function to handle deletion of school data
    function deleteSchool(schoolId) {
        if (confirm('Apakah Anda yakin ingin menghapus data sekolah ini?')) {
            alert(`Data sekolah dengan ID ${schoolId} dihapus.`);
            // Here, you would normally call an API to delete the school
        }
    }

    // Pagination logic (basic example)
    let currentPage = 1;
    const rowsPerPage = 5;

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            updatePagination();
        }
    }

    function nextPage() {
        currentPage++;
        updatePagination();
    }

    function updatePagination() {
        const rows = document.querySelectorAll('.school-row');
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        rows.forEach((row, index) => {
            if (index >= start && index < end) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        document.getElementById('pageNumber').textContent = `Halaman ${currentPage}`;
    }

    // Initialize pagination
    updatePagination();
</script>

@endsection