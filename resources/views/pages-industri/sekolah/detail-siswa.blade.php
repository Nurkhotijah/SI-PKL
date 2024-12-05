@extends('components.layout-industri')

@section('title', 'Lihat Data Siswa PKL')

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
                   
                </div>
            </div>

            <div class="overflow-x-auto"> 
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
                            <td class="py-2 px-4 border-b">pkl qelopak</td>
                            <td class="py-2 px-4 border-b">2025</td>
                            <td class="py-2 px-4 border-b text-center">2025-12-01</td>
                            <td class="py-2 px-4 border-b text-center">2025-02-28</td>
                            <td class="py-2 px-4 border-b">PPLG</td>
                            <td class="py-2 px-4 border-b">Arif Hidayat S.Kom</td>
                            <td class="py-2 px-4 border-b text-center">
                                <!-- Preview CV when clicked -->
                                <a href="#" class="text-blue-500 hover:underline" onclick="previewCV('cv1.pdf')">Preview CV</a>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <span class="bg-yellow-200 text-yellow-800 text-xs px-2 py-1 rounded-full">Menunggu</span>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="{{ route('lihat-detail') }}" class="text-blue-500 hover:text-blue-700">Lihat</a>                                 
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