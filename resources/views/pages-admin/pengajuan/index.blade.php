@extends('components.layout-admin')

@section('title', 'Pengajuan Siswa')

@section('content')
<div class="bg-gray-100">
    <main class="p-6 overflow-y-auto h-full">
        <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
            <!-- Header Section -->
            <div class="mb-4">
                <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Pengajuan Siswa</h1>
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0 sm:space-x-4">
                    <div class="relative w-full sm:w-auto">
                        <input class="border rounded p-2 pl-10 w-full sm:w-64" id="search" placeholder="Cari Nama Siswa" type="text" oninput="searchTable()">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <!-- Add Student Button -->
                    <div class="flex flex-row space-x-2 mt-4 sm:mt-0">
                        <a href="{{ route('pengajuan-index') }}" class="bg-green-500 text-white text-xs px-4 py-2 rounded shadow hover:bg-green-600 transition duration-300 ease-in-out">
                            <i class="fas fa-plus-circle mr-2"></i>Tambah Pengajuan
                        </a>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto"> <!-- Menyembunyikan scroll horizontal di perangkat kecil -->
                <table class="min-w-full bg-white border" id="studentTable">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b text-center">No</th>
                            <th class="py-2 px-4 border-b text-left">Judul PKL</th>
                            <th class="py-2 px-4 border-b text-left">Tahun Ajaran</th>
                            <th class="py-2 px-4 border-b text-center">Tanggal Mulai PKL</th>
                            <th class="py-2 px-4 border-b text-center">Tanggal Selesai PKL</th>
                            <th class="py-2 px-4 border-b text-left">Jurusan</th>
                            <th class="py-2 px-4 border-b text-left">Pembimbing</th>
                            <th class="py-2 px-4 border-b text-center">Lampiran</th>
                            <th class="py-2 px-4 border-b text-center">Status Persetujuan</th>
                            <th class="py-2 px-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data PKL -->
                        <tr>
                            <td class="py-2 px-4 border-b text-center">1</td>
                            <td class="py-2 px-4 border-b">Pengembangan Aplikasi Mobile</td>
                            <td class="py-2 px-4 border-b">2024/2025</td>
                            <td class="py-2 px-4 border-b text-center">2024-12-01</td>
                            <td class="py-2 px-4 border-b text-center">2025-02-28</td>
                            <td class="py-2 px-4 border-b">PPLG</td>
                            <td class="py-2 px-4 border-b">Bapak Arif Hidayat</td>
                            <td class="py-2 px-4 border-b text-center">
                                <!-- Preview CV when clicked -->
                                <a href="#" class="text-blue-500 hover:underline" onclick="previewCV('cv1.pdf')">Preview CV</a>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <span class="bg-yellow-200 text-yellow-800 text-xs px-2 py-1 rounded-full">Menunggu</span>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="{{ route('lihat-siswa') }}" class="text-blue-500 hover:text-blue-700">Lihat</a>                                 
                                <button onclick="hapusData(this)" class="text-red-500 hover:text-red-700 ml-2">Hapus</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b text-center">2</td>
                            <td class="py-2 px-4 border-b">Desain Sistem Jaringan</td>
                            <td class="py-2 px-4 border-b">2023/2024</td>
                            <td class="py-2 px-4 border-b text-center">2024-01-15</td>
                            <td class="py-2 px-4 border-b text-center">2024-03-30</td>
                            <td class="py-2 px-4 border-b">BCF</td>
                            <td class="py-2 px-4 border-b">Ibu Rina Kurniawati</td>
                            <td class="py-2 px-4 border-b text-center">
                                <!-- Preview CV when clicked -->
                                <a href="#" class="text-blue-500 hover:underline" onclick="previewCV('cv2.pdf')">Preview CV</a>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <span class="bg-green-200 text-green-800 text-xs px-2 py-1 rounded-full">Disetujui</span>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <button onclick="lihatData(this)" class="text-blue-500 hover:text-blue-700">Lihat</button>
                                <button onclick="hapusData(this)" class="text-red-500 hover:text-red-700 ml-2">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Preview Modal -->
            <div id="previewModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-6 rounded-lg max-w-lg w-full">
                    <div class="mb-4">
                        <button onclick="closePreview()" class="absolute top-0 right-0 p-2 text-gray-500">X</button>
                        <h2 class="text-lg font-bold">Preview CV</h2>
                        <embed id="cvPreview" class="w-full h-96" src="" type="application/pdf">
                    </div>
                </div>
            </div>
            
            <script>
                function hapusData(button) {
                    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                        // Menghapus baris tabel
                        button.closest('tr').remove();
                    }
                }

                function lihatData(button) {
                    alert('Fungsi untuk melihat data belum tersedia.');
                }

                // Function to open CV preview
                function previewCV(fileName) {
                    const previewModal = document.getElementById('previewModal');
                    const cvPreview = document.getElementById('cvPreview');
                    cvPreview.src = '/path/to/cv/' + fileName; // Sesuaikan dengan path tempat menyimpan file
                    previewModal.classList.remove('hidden');
                }

                // Function to close CV preview
                function closePreview() {
                    const previewModal = document.getElementById('previewModal');
                    previewModal.classList.add('hidden');
                }
            </script>
        </div>
    </main>
</div>
@endsection
