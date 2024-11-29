@extends('components.layout-industri')

@section('title', 'Detail Jurnal Siswa')

@section('content')
  
<main class="p-6 overflow-y-auto h-full">
    <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        <!-- Header Section -->
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Detail Jurnal Siswa</h1>
            <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0 sm:space-x-4">
        </div>

       <!-- Table Section -->
       @foreach($listdetail as $item)
       <tr>
           <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
           <td class="py-2 px-4 border-b text-left">{{ $item->kegiatan }}</td>
           <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
           <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($item->waktu_mulai)->format('H:i') }}</td>
           <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($item->waktu_selesai)->format('H:i') }}</td>
           <td class="py-2 px-4 border-b text-center">
               <img src="{{ asset('storage/'.$item->foto_kegiatan) }}" alt="Foto Kegiatan" class="w-16 h-16 object-cover rounded-full cursor-pointer" onclick="showActivityImage('{{ asset('storage/'.$item->foto_kegiatan) }}')">
           </td>
       </tr>
       @endforeach
       

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
