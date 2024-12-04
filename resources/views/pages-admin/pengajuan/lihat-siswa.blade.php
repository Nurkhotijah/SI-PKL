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
                    <!-- Add Student Button -->
                    <div class="flex flex-row space-x-2 mt-4 sm:mt-0">
                        <a href="{{ route('pengajuan.create') }}" class="bg-blue-500 text-white text-xs px-4 py-2 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out">
                            <i class="fas fa-user-plus mr-2"></i>Tambah Siswa
                        </a>
                    </div>
                
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border" id="studentTable">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b text-center">No</th>
                            <th class="py-2 px-4 border-b text-left">Nama Lengkap</th>
                            <th class="py-2 px-4 border-b text-center">CV</th>
                            <th class="py-2 px-4 border-b text-center">Status Persetujuan</th>
                            <th class="py-2 px-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data PKL -->
                        <tr>
                            <td class="py-2 px-4 border-b text-center">1</td>
                            <td class="py-2 px-4 border-b">John Doe</td>
                            <td class="py-2 px-4 border-b text-center">
                                <!-- Tautan untuk melihat CV -->
                                <button onclick="previewCV('path/to/cv-john.pdf')" class="text-blue-500 hover:underline">Lihat CV</button>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <span class="bg-yellow-200 text-yellow-800 text-xs px-2 py-1 rounded-full">Menunggu</span>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <button onclick="hapusData(this)" class="text-red-500 hover:text-red-700 ml-2">Hapus</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b text-center">2</td>
                            <td class="py-2 px-4 border-b">Jane Smith</td>
                            <td class="py-2 px-4 border-b text-center">
                                <!-- Tautan untuk melihat CV -->
                                <button onclick="previewCV('path/to/cv-jane.pdf')" class="text-blue-500 hover:underline">Lihat CV</button>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <span class="bg-green-200 text-green-800 text-xs px-2 py-1 rounded-full">Disetujui</span>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <button onclick="hapusData(this)" class="text-red-500 hover:text-red-700 ml-2">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            {{-- <!-- Modal untuk preview CV -->
            <div id="cvModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">
                <div class="bg-white p-4 w-11/12 md:w-1/2">
                    <button onclick="closeModal()" class="text-red-500 hover:text-red-700 text-lg absolute top-2 right-2">X</button>
                    <iframe id="cvPreview" class="w-full h-96" src="" frameborder="0"></iframe>
                </div>
            </div>
             --}}
            
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

    //             // Fungsi untuk membuka modal dengan file CV
    // function previewCV(cvPath) {
    //     const modal = document.getElementById('cvModal');
    //     const iframe = document.getElementById('cvPreview');
    //     iframe.src = cvPath;  // Ubah dengan path file CV yang sesuai
    //     modal.classList.remove('hidden');  // Menampilkan modal
    // }

    // // Fungsi untuk menutup modal
    // function closeModal() {
    //     const modal = document.getElementById('cvModal');
    //     const iframe = document.getElementById('cvPreview');
    //     iframe.src = "";  // Hapus sumber iframe agar file tidak tetap terbuka
    //     modal.classList.add('hidden');  // Menyembunyikan modal
    // }
            </script>
            


@endsection