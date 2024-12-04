@extends('components.layout-admin')

@section('title', 'Pengajuan Siswa')

@section('content')


<div class="bg-white p-8 rounded-lg shadow-md max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-center">Formulir Pengajuan PKL</h2>
    <form>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Judul PKL -->
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700">Judul PKL</label>
                <input 
                    type="text" 
                    name="judul" 
                    id="judul" 
                    class="w-full p-2 border rounded-lg" 
                    required>
            </div>

            <!-- Tahun Ajaran -->
            <div>
                <label for="tahun_ajaran" class="block text-sm font-medium text-gray-700">Tahun Ajaran</label>
                <input 
                    type="text" 
                    name="tahun_ajaran" 
                    id="tahun_ajaran" 
                    class="w-full p-2 border rounded-lg" 
                    placeholder="Contoh: 2024/2025" 
                    required>
            </div>

            <!-- Tanggal Mulai -->
            <div>
                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai PKL</label>
                <input 
                    type="date" 
                    name="tanggal_mulai" 
                    id="tanggal_mulai" 
                    class="w-full p-2 border rounded-lg" 
                    required>
            </div>

            <!-- Tanggal Selesai -->
            <div>
                <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai PKL</label>
                <input 
                    type="date" 
                    name="tanggal_selesai" 
                    id="tanggal_selesai" 
                    class="w-full p-2 border rounded-lg" 
                    required>
            </div>

            <!-- Jurusan -->
            <div>
                <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
                <input 
                    type="text" 
                    name="jurusan" 
                    id="jurusan" 
                    class="w-full p-2 border rounded-lg" 
                    required>
            </div>

            <!-- Pembimbing -->
            <div>
                <label for="pembimbing" class="block text-sm font-medium text-gray-700">Pembimbing</label>
                <input 
                    type="text" 
                    name="pembimbing" 
                    id="pembimbing" 
                    class="w-full p-2 border rounded-lg" 
                    required>
            </div>

            <!-- Upload File -->
            <div class="col-span-1 sm:col-span-2">
                <label for="file" class="block text-sm font-medium text-gray-700">Upload File</label>
                <input 
                    type="file" 
                    name="file" 
                    id="file" 
                    class="w-full p-2 border rounded-lg">
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="mt-6 text-center">
            <button 
                type="submit" 
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">
                Simpan
            </button>
        </div>
    </form>
</div>

@endsection
