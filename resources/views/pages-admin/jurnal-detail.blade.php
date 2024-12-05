@extends('components.layout-admin')

@section('title', ' Detail Jurnal Siswa')

@section('content')

<main class="p-6 overflow-y-auto h-full">
    <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        <!-- Header Section -->
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Detail Jurnal Siswa</h1>
           
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border" id="pengajuanTable">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b text-center">No</th>
                        <th class="py-2 px-4 border-b text-left">Kegiatan</th>
                        <th class="py-2 px-4 border-b text-center">Tanggal</th>
                        <th class="py-2 px-4 border-b text-center">Waktu Mulai</th>
                        <th class="py-2 px-4 border-b text-center">Waktu Selesai</th>
                        <th class="py-2 px-4 border-b text-center">Foto</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example Row 1 -->
                    <tr>
                        <td class="py-2 px-4 border-b text-center">1</td>
                        <td class="py-2 px-4 border-b text-left">Mengerjakan kelola nilai</td>
                        <td class="py-2 px-4 border-b text-center">2023-10-01</td>
                        <td class="py-2 px-4 border-b text-center">08:00</td>
                        <td class="py-2 px-4 border-b text-center">16:00</td>
                        <td class="py-2 px-4 border-b text-center">
                            <img src="assets/coding.png" alt="Foto Kegiatan 1" class="w-16 h-16 object-cover rounded-full cursor-pointer" onclick="showActivityImage('assets/coding.png')">
                        </td>
                    </tr>
                    <!-- Example Row 2 -->
                    <tr>
                        <td class="py-2 px-4 border-b text-center">2</td>
                        <td class="py-2 px-4 border-b text-left">Marsya</td>
                        <td class="py-2 px-4 border-b text-center">2023-10-02</td>
                        <td class="py-2 px-4 border-b text-center">09:00</td>
                        <td class="py-2 px-4 border-b text-center">17:00</td>
                        <td class="py-2 px-4 border-b text-center">
                            <img src="assets/coding.png" alt="Foto Kegiatan 1" class="w-16 h-16 object-cover rounded-full cursor-pointer" onclick="showActivityImage('assets/coding.png')">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal untuk menampilkan gambar besar -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-4 relative max-w-md w-full">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-black">
            ✕
        </button>
        <img id="activityImage" src="" alt="Activity Image" class="w-full rounded-md">
    </div>
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



<script>
  
   // Fungsi untuk menampilkan gambar besar di modal
   function showActivityImage(imageSrc) {
        const modal = document.getElementById('imageModal');
        const image = document.getElementById('activityImage');
        image.src = imageSrc;
        modal.classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
    }


    // Pagination functions (for simplicity, just placeholder)
    let currentPage = 1;
    const rowsPerPage = 5;
    const totalRows = document.querySelectorAll('#pengajuanTable tbody tr').length;

    function updateTable() {
        const rows = document.querySelectorAll('#pengajuanTable tbody tr');
        rows.forEach((row, index) => {
            if (index >= (currentPage - 1) * rowsPerPage && index < currentPage * rowsPerPage) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        document.getElementById('pageNumber').textContent = `Halaman ${currentPage}`;
    }

    function nextPage() {
        if (currentPage * rowsPerPage < totalRows) {
            currentPage++;
            updateTable();
        }
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            updateTable();
        }
    }

    updateTable();
</script>


@endsection