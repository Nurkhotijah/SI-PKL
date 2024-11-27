@extends('components.layout-user')

@section('title', 'Jurnal Kegiatan')

@section('content')

<main class="p-6 overflow-y-auto h-full">
    <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        <!-- Header Section -->
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Jurnal</h1>
            <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0 sm:space-x-4">
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex space-x-4 mt-4 sm:mt-0">
            <a href="{{ route('tambah-jurnal') }}" class="bg-blue-500 text-white text-xs px-4 py-2 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out">
                <i class="fas fa-user-plus mr-2"></i>Tambah Jurnal
            </a>
           <!-- Tombol untuk mengupload laporan PKL -->
<a href="javascript:void(0)" class="bg-blue-500 text-white text-xs px-4 py-2 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out" onclick="document.getElementById('fileInput').click();">
    <i class="fas fa-upload mr-2"></i>Upload Laporan
</a>

<!-- Input file untuk memilih laporan PKL, hanya menerima file PDF -->
<input type="file" id="laporan_pkl" name="laporan_pkl" class="hidden" accept=".pdf" onchange="uploadFile(event)">

        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white border" id="pengajuanTable">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b text-center">No</th>
                        <th class="py-2 px-4 border-b text-left">Kegiatan</th>
                        <th class="py-2 px-4 border-b text-center">Tanggal</th>
                        <th class="py-2 px-4 border-b text-center">Waktu Mulai</th>
                        <th class="py-2 px-4 border-b text-center">Waktu Selesai</th>
                        <th class="py-2 px-4 border-b text-center">Laporan PKL</th>
                        <th class="py-2 px-4 border-b text-center">Foto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jurnal as $index => $data)
                        <tr>
                            <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $data->kegiatan }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($data->waktu_mulai)->format('H:i') }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($data->waktu_selesai)->format('H:i') }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <button onclick="openLaporanModal('{{ asset('storage/'.$data->laporan_pkl) }}')"
                                        class="bg-green-500 text-white text-xs px-3 py-1 rounded shadow hover:bg-green-600 transition duration-300 ease-in-out">
                                    <i class="fas fa-file-pdf mr-1"></i> Unduh
                                </button>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <img src="{{ asset('storage/'.$data->foto_kegiatan) }}" alt="Foto Kegiatan" class="w-14 h-14 object-cover rounded-full cursor-pointer" onclick="showActivityImage('{{ asset('storage/'.$data->foto_kegiatan) }}')">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        

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

<!-- Modal untuk menampilkan laporan PKL -->
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" id="modal-laporan" onclick="closeLaporanModal()">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full sm:w-3/4 lg:w-1/2" onclick="event.stopPropagation();">
        <h2 class="text-xl font-bold mb-4 flex justify-between items-center">
            Laporan PKL Siswa
            <span class="cursor-pointer text-black" onclick="closeLaporanModal()">×</span>
        </h2>
        <iframe id="laporanContent" src="" class="w-full h-96 rounded-lg border"></iframe>
    </div>
</div>



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

    function openLaporanModal(fileUrl) {
    const modal = document.getElementById('modal-laporan');
    const iframe = document.getElementById('laporanContent');
    iframe.src = fileUrl;
    modal.classList.remove('hidden');
}

function closeLaporanModal() {
    const modal = document.getElementById('modal-laporan');
    const iframe = document.getElementById('laporanContent');
    iframe.src = ""; // Reset iframe untuk menghindari masalah caching
    modal.classList.add('hidden');
}

    function filterTable() {
        let searchValue = document.getElementById('search').value.toLowerCase();
        let rows = document.querySelectorAll('#pengajuanTable tbody tr');
        rows.forEach(row => {
            let cells = row.querySelectorAll('td');
            let name = cells[1].textContent.toLowerCase();
            let school = cells[2].textContent.toLowerCase();
            if (name.includes(searchValue) || school.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function filterBySchool() {
        let schoolFilter = document.getElementById('school').value.toLowerCase();
        let rows = document.querySelectorAll('#pengajuanTable tbody tr');
        rows.forEach(row => {
            let school = row.querySelectorAll('td')[2].textContent.toLowerCase();
            if (school.includes(schoolFilter) || schoolFilter === '') {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function showActivityImage(imageSrc) {
        document.getElementById('activityImage').src = imageSrc;
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
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