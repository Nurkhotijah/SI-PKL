@extends('components.layout-user')

@section('title', 'Riwayat Kehadiran')

@section('content')
<!-- Main Content -->
<main class="bg-gray-100 p-8">
    <div class="container mx-auto bg-white p-6 shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Riwayat Kehadiran</h1>
       <!-- Tombol Upload Foto Izin -->
<div class="mt-4 sm:mt-0 mb-4 flex absensis-center space-x-4">
    <form action="{{ route('uploadFotoIzin') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="uploadIzin" class="bg-blue-500 text-white text-xs px-6 py-3 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out cursor-pointer flex absensis-center w-auto">
            <i class="fas fa-upload mr-2"></i> Upload Foto Izin
        </label>
        <input type="file" id="uploadIzin" name="foto_izin" class="hidden" accept="image/jpeg, image/png" required>
        <button type="submit" class="hidden">Submit</button>
    </form>    

    <!-- Tombol Unduh Rekap Kehadiran -->
    <a class="bg-green-500 text-white text-xs px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300 ease-in-out flex absensis-center space-x-2 w-auto" 
       href="{{ asset('path/to/certificate.pdf') }}" 
       download="Sertifikat_PKL_{{ Auth::user()->name }}">
        <i class="fas fa-download"></i>
        <span>Rekap Kehadiran</span>
    </a>
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
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($kehadiran as $absensi)
            <tr class="bg-white hover:bg-gray-50 transition duration-200 ease-in-out">
                <td class="py-4 px-4 border-b border-gray-300 text-gray-700">{{ $loop->iteration }}</td>
                <td class="py-4 px-4 border-b border-gray-300 text-gray-800">{{ $absensi->name }}</td>
                <td class="py-4 px-4 border-b border-gray-300 text-gray-600">{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d M Y') }}</td>
                <td class="py-4 px-4 border-b border-gray-300 text-gray-600">{{ $absensi->status_kehadiran }}</td>
                <td class="py-4 px-4 border-b border-gray-300 text-gray-600">{{ \Carbon\Carbon::parse($absensi->waktu_masuk)->format('H:i') }}</td>
                <td class="py-4 px-4 border-b border-gray-300 text-gray-600">{{ \Carbon\Carbon::parse($absensi->waktu_keluar)->format('H:i') }}</td>
                <td class="py-4 px-4 border-b border-gray-300 text-center">
                    @if($absensi->foto_izin)
                    <img class="w-16 h-16 object-cover rounded-full mx-auto" src="{{ asset('storage/foto_izin/' . $absensi->foto_izin) }}" alt="Foto Izin">
                    @else
                    Tidak ada foto
                    @endif
                </td>
                <td class="py-4 px-4 border-b border-gray-300 text-center">
                    <button 
                        class="bg-blue-500 text-white px-4 py-2 rounded-full shadow-lg hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105"
                        onclick="openModal({{ $absensi->id }})">
                        <i class="fas fa-eye"></i> Lihat
                    </button>
                </td>                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

        
        <!-- Pagination -->
        <div class="flex justify-end absensis-center mt-4">
            <span class="mr-4" id="pageNumber">Halaman 1</span>
            <button class="bg-gray-300 text-gray-700 p-2 rounded mr-2" onclick="prevPage()">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="bg-gray-300 text-gray-700 p-2 rounded" onclick="nextPage()">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
    @foreach($kehadiran as $absensi)
    <!-- Modal untuk Foto Absen Masuk dan Keluar -->
    <div class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 hidden" id="modal-{{ $absensi->id }}">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96" onclick="event.stopPropagation();">
            <h2 class="text-xl font-bold mb-4 flex justify-between">
                Lihat Foto Kehadiran
                <span class="cursor-pointer text-black" onclick="closeModal({{ $absensi->id }})">×</span>
            </h2>
            <div class="flex justify-around">
                <div class="flex flex-col items-center">
                    <button class="text-black font-semibold px-4 py-2 hover:underline" id="checkInButton-{{ $absensi->id }}" onclick="showImage('checkIn', {{ $absensi->id }})">
                        Masuk
                    </button>
                    <div class="border-b border-green-500 w-16 mt-1"></div>
                </div>
                <div class="flex flex-col items-center">
                    <button class="text-black font-semibold px-4 py-2 hover:underline" id="checkOutButton-{{ $absensi->id }}" onclick="showImage('checkOut', {{ $absensi->id }})">
                        Pulang
                    </button>
                    <div class="border-b border-red-500 w-16 mt-1"></div>
                </div>
            </div>
            <div class="mt-4 hidden" id="checkInImage-{{ $absensi->id }}">
                <img alt="Absen Masuk" class="w-full h-auto rounded-lg shadow-md transition-transform transform hover:scale-105" src="{{ asset('storage/'.$absensi->foto_masuk) }}"/>
            </div>
            <div class="hidden mt-4" id="checkOutImage-{{ $absensi->id }}">
                <img alt="Absen Keluar" class="w-full h-auto rounded-lg shadow-md transition-transform transform hover:scale-105" src="{{ asset('storage/'.$absensi->foto_keluar) }}"/>
            </div>
        </div>
    </div>
    @endforeach
    
</main>
@endsection