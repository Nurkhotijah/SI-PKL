@extends('components.layout-industri')

@section('title', 'Tambah Rekap Kehadiran')

@section('content')

<main class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-6xl">
        <h1 class="text-2xl font-bold text-center mb-6">Tambah Kehadiran Siswa</h1>


        <form>
            <div class="grid grid-cols-3 gap-6">
                <div>
                    <label class="block mb-2">Nama Siswa</label>
                    <input id="nama_siswa" type="text" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block mb-2">Nama Sekolah</label>
                    <input id="nama_sekolah" type="text" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block mb-2">Program Keahlian</label>
                    <input id="program_keahlian" type="text" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block mb-2">Nama Perusahaan</label>
                    <input id="nama_perusahaan" type="text" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block mb-2">Lama Praktik</label>
                    <input id="lama_praktik" type="text" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block mb-2">Total Hadir</label>
                    <input id="total_hadir" type="text" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block mb-2">Total Tidak Hadir</label>
                    <input id="total_tidak_hadir" type="text" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block mb-2">Total Izin</label>
                    <input id="total_izin" type="text" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block mb-2">TTD Pembimbing Sekolah</label>
                    <input type="file" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block mb-2">NIP Pembimbing Sekolah</label>
                    <input id="nip_pembimbing_sekolah" type="text" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block mb-2">TTD Pembimbing Industri</label>
                    <input type="file" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block mb-2">NIP Pembimbing IDUKA</label>
                    <input id="nip_pembimbing_industri" type="text" class="w-full p-2 border border-gray-300 rounded">
                </div>
            </div>
            <div class="mt-6 text-right">
                <button type="button" id="saveButton" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
        
        <script>
            document.getElementById('saveButton').addEventListener('click', function() {
                // Ambil data dari form
                const namaSiswa = document.getElementById('nama_siswa').value;
                const namaSekolah = document.getElementById('nama_sekolah').value;
                const programKeahlian = document.getElementById('program_keahlian').value;
                const namaPerusahaan = document.getElementById('nama_perusahaan').value;
                const lamaPraktik = document.getElementById('lama_praktik').value;
                const totalHadir = document.getElementById('total_hadir').value;
                const totalTidakHadir = document.getElementById('total_tidak_hadir').value;
                const totalIzin = document.getElementById('total_izin').value;
        
                // Simpan data ke localStorage (bisa diganti dengan pengiriman data ke server)
                localStorage.setItem('attendanceData', JSON.stringify({
                    namaSiswa,
                    namaSekolah,
                    programKeahlian,
                    namaPerusahaan,
                    lamaPraktik,
                    totalHadir,
                    totalTidakHadir,
                    totalIzin
                }));
        
                // Notifikasi data berhasil disimpan
                alert('Data berhasil disimpan!');
        
                // Arahkan kembali ke halaman "Kelola Kehadiran"
                window.location.href = '/kehadiran-siswa'; // Ganti dengan path halaman Kelola Kehadiran yang benar
            });
        
            // Mengisi form dengan data yang tersimpan saat halaman dimuat
            window.onload = function() {
                const storedData = JSON.parse(localStorage.getItem('attendanceData'));
                if (storedData) {
                    document.getElementById('nama_siswa').value = storedData.namaSiswa;
                    document.getElementById('nama_sekolah').value = storedData.namaSekolah;
                    document.getElementById('program_keahlian').value = storedData.programKeahlian;
                    document.getElementById('nama_perusahaan').value = storedData.namaPerusahaan;
                    document.getElementById('lama_praktik').value = storedData.lamaPraktik;
                    document.getElementById('total_hadir').value = storedData.totalHadir;
                    document.getElementById('total_tidak_hadir').value = storedData.totalTidakHadir;
                    document.getElementById('total_izin').value = storedData.totalIzin;
                }
            }
        </script>
        
@endsection

