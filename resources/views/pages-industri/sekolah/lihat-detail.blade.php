@extends('components.layout-industri')

@section('title', 'Lihat Data Siswa PKL')

@section('content')
<div class="mb-4">
    <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Siswa PKL</h1>
    <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0 sm:space-x-4">
        
        <!-- Tombol aksi multiple -->
        <div class="flex space-x-2">
            <button onclick="updateMultipleStatus('diterima')" class="bg-green-400 text-white text-xs px-4 py-2 rounded shadow hover:bg-green-500 transition duration-300 ease-in-out">
                <i class="fas fa-check mr-1"></i> Terima
            </button>
            <button onclick="updateMultipleStatus('ditolak')" class="bg-red-400 text-white text-xs px-4 py-2 rounded shadow hover:bg-red-500 transition duration-300 ease-in-out">
                <i class="fas fa-times mr-1"></i> Tolak
            </button>
        </div>
        <div class="mb-4 flex justify-end">
            <button 
                onclick="alert('Push Sertifikat hanya tersedia untuk prototipe ini.')" 
                class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out"
            >
                Push Sertifikat
            </button>
        </div>        
    </div>
</div>

<!-- Tabel -->
<div class="overflow-x-auto">
    <table class="min-w-full bg-white border" id="studentTable">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4 border-b text-center">
                    <input type="checkbox" id="checkAll" class="student-checkbox-master">
                </th>
                <th class="py-2 px-4 border-b text-center">No</th>
                <th class="py-2 px-4 border-b text-left">Nama Siswa</th>
                <th class="py-2 px-4 border-b text-center">CV</th>
                <th class="py-2 px-4 border-b text-center">Status Persetujuan</th>
            </tr>
        </thead>
        <tbody>
            <tr class="student-row">
                <td class="py-2 px-4 border-b text-center">
                    <input type="checkbox" class="student-checkbox">
                </td>
                <td class="py-2 px-4 border-b text-center">1</td>
                <td class="py-2 px-4 border-b text-left">Nama Siswa 1</td>
                <td class="py-2 px-4 border-b text-center">
                    <a href="#" 
                       onclick="showCVPreview('cv1.pdf')" 
                       class="text-blue-500 hover:underline">Preview</a>
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <span class="bg-yellow-200 text-yellow-800 text-xs px-2 py-1 rounded-full">pending</span>
                </td>
            </tr>
            <tr class="student-row">
                <td class="py-2 px-4 border-b text-center">
                    <input type="checkbox" class="student-checkbox">
                </td>
                <td class="py-2 px-4 border-b text-center">2</td>
                <td class="py-2 px-4 border-b text-left">Nama Siswa 2</td>
                <td class="py-2 px-4 border-b text-center">
                    <a href="#" 
                       onclick="showCVPreview('cv2.pdf')" 
                       class="text-blue-500 hover:underline">Preview</a>
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <span class="bg-green-200 text-green-800 text-xs px-2 py-1 rounded-full">diterima</span>
                </td>
            </tr>
        </tbody>
        
        <!-- Modal -->
        <div id="cvModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg w-3/4 h-3/4">
                <button onclick="closeCVPreview()" 
                        class="absolute top-2 right-4 bg-red-500 text-white px-2 py-1 rounded">Tutup</button>
                <iframe id="cvIframe" src="" class="w-full h-full"></iframe>
            </div>
        </div>
    </table>
</div>

<script>
     function showCVPreview(cvPath) {
        // Atur file CV yang akan ditampilkan
        const modal = document.getElementById('cvModal');
        const iframe = document.getElementById('cvIframe');
        iframe.src = cvPath; // Path ke file CV
        modal.classList.remove('hidden'); // Tampilkan modal
    }

    function closeCVPreview() {
        // Sembunyikan modal
        const modal = document.getElementById('cvModal');
        const iframe = document.getElementById('cvIframe');
        iframe.src = ''; // Reset iframe
        modal.classList.add('hidden');
    }
    document.getElementById('checkAll').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('.student-checkbox:not(:disabled)');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    document.querySelectorAll('.student-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const allCheckboxes = document.querySelectorAll('.student-checkbox:not(:disabled)');
            const allChecked = Array.from(allCheckboxes).every(checkbox => checkbox.checked);
            document.getElementById('checkAll').checked = allChecked;
        });
    });

    function updateMultipleStatus(status) {
        const selectedCheckboxes = document.querySelectorAll('.student-checkbox:checked');
        if (selectedCheckboxes.length === 0) {
            alert('Pilih setidaknya satu siswa untuk memperbarui status.');
            return;
        }
        alert(`Status siswa akan diubah menjadi: ${status}`);
    }

    function searchTable() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const rows = document.querySelectorAll('.student-row');
        rows.forEach(row => {
            const studentName = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            row.style.display = studentName.includes(searchInput) ? '' : 'none';
        });
    }
</script>
@endsection
