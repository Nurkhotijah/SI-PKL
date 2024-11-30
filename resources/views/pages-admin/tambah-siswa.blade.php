@extends('components.layout-admin')

@section('title', 'Tambah Pengajuan Siswa')

@section('content')
<div class="bg-gray-100 h-screen flex items-center justify-center">
    <!-- Tambahkan margin atas untuk menaikkan kotak -->
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-4xl mt-[-130px]">
        <h2 class="text-2xl font-bold mb-6 text-center">Formulir Pengajuan PKL</h2>
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('pengajuan-siswa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Siswa -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nama Siswa</label>
                    <input type="text" id="nama_siswa" name="nama_siswa" placeholder="Masukkan nama siswa" class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <!-- Jurusan -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Jurusan</label>
                    <input type="text" id="jurusan" name="jurusan" placeholder="Masukkan jurusan siswa" class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                </div>
        
                <!-- Tanggal Mulai PKL -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Mulai (PKL)</label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                </div>
        
                <!-- Tanggal Selesai PKL -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Selesai (PKL)</label>
                    <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <!-- Upload CV -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Upload CV</label>
                    <input type="file" accept=".pdf" id="cv" name="cv" class="w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <!-- Tombol Submit -->
                <div class="col-span-2 flex justify-end">
                    <button type="submit" id="submitBtn" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Ajukan
                    </button>
                </div>
            </div>
        </form>
            
        
    </div>
</div>

@endsection

