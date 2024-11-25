@extends('components.layout-user')

@section('title', 'Tambah Jurnal ')

@section('content')

<div class="max-w-7xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Form Jurnal</h1>
    <form id="jurnalForm">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <div class="flex flex-col">
                <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi Kegiatan</label>
                <textarea id="deskripsi" class="w-full p-3 border border-gray-300 rounded-md" placeholder="Masukkan deskripsi kegiatan"></textarea>
            </div>

            <div class="flex flex-col">
                <label for="tanggal" class="block text-gray-700 font-semibold mb-2">Tanggal Laporan</label>
                <div class="relative">
                    <input type="text" id="tanggal" class="w-full p-3 border border-gray-300 rounded-md" placeholder="dd/mm/yyyy">
                    <i class="fas fa-calendar-alt absolute right-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <div class="flex flex-col">
                <label for="jam-mulai" class="block text-gray-700 font-semibold mb-2">Jam Mulai</label>
                <div class="relative">
                    <input type="text" id="jam-mulai" class="w-full p-3 border border-gray-300 rounded-md" placeholder="--:--">
                    <i class="fas fa-clock absolute right-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <div class="flex flex-col">
                <label for="jam-selesai" class="block text-gray-700 font-semibold mb-2">Jam Selesai</label>
                <div class="relative">
                    <input type="text" id="jam-selesai" class="w-full p-3 border border-gray-300 rounded-md" placeholder="--:--">
                    <i class="fas fa-clock absolute right-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <div class="flex flex-col">
                <label for="foto" class="block text-gray-700 font-semibold mb-2">Foto Bukti Kegiatan</label>
                <input type="file" id="foto" class="w-full p-3 border border-gray-300 rounded-md">
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-blue-500 text-white font-semibold py-3 px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Kirim Jurnal Kegiatan
            </button>
        </div>
    </form>
</div>

@endsection