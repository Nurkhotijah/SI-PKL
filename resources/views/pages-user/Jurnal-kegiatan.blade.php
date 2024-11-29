@extends('components.layout-user')

@section('title', 'Jurnal Kegiatan')

@section('content')

<main class="p-6 overflow-y-auto h-full">
    <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        <!-- Header Section -->
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Jurnal</h1>
        </div>

        <!-- Action Buttons Section -->
        <div class="flex space-x-4 mb-6">
            <!-- Tombol Tambah Jurnal -->
            <a href="{{ route('tambah-jurnal') }}" class="bg-blue-500 text-white text-xs px-4 py-2 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out">
                <i class="fas fa-user-plus mr-2"></i> Tambah Jurnal
            </a>

            @foreach($jurnal as $data)
    <form action="{{ route('jurnal.upload', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data" class="inline-block">
        @csrf
        <input type="file" name="laporan_pkl" accept=".pdf" id="fileInput-{{ $data->id }}" class="hidden" onchange="this.form.submit()">
        <button type="button" onclick="document.getElementById('fileInput-{{ $data->id }}').click()" 
                class="bg-blue-500 text-white text-xs px-4 py-2 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out">
            <i class="fas fa-upload mr-2"></i> Upload Laporan PKL
        </button>
    </form>
@endforeach

        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border" id="pengajuanTable">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b text-center">No</th>
                        <th class="py-2 px-4 border-b text-left">Kegiatan</th>
                        <th class="py-2 px-4 border-b text-center">Tanggal</th>
                        <th class="py-2 px-4 border-b text-center">Waktu Mulai</th>
                        <th class="py-2 px-4 border-b text-center">Waktu Selesai</th>
                        <th class="py-2 px-4 border-b text-center">Foto</th>
                        <th class="py-2 px-4 border-b text-center">Laporan PKL</th>
                        <th class="py-2 px-4 border-b text-center">Aksi</th>
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
                                <img src="{{ asset('storage/'.$data->foto_kegiatan) }}" alt="Foto Kegiatan" class="w-14 h-14 object-cover rounded-full cursor-pointer" onclick="showActivityImage('{{ asset('storage/'.$data->foto_kegiatan) }}')">
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                @if($data->laporan_pkl)
                                    <a href="{{ asset('storage/'.$data->laporan_pkl) }}" target="_blank" 
                                       class="bg-green-500 text-white text-xs px-3 py-1 rounded shadow hover:bg-green-600 transition duration-300 ease-in-out">
                                        <i class="fas fa-file-pdf mr-1"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-gray-500 text-xs italic">Belum ada laporan</span>
                                @endif
                            </td>                            
                            <td class="py-2 px-4 border-b text-center">
                                <a href="{{ route('jurnal-kegiatan.edit', ['id' => $data->id]) }}" class="bg-blue-500 text-white text-xs px-3 py-1 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('jurnal-kegiatan.destroy', ['id' => $data->id]) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white text-xs px-3 py-1 rounded shadow hover:bg-red-600 transition duration-300 ease-in-out">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </button>
                                </form>
                            </td>                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

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


@endsection