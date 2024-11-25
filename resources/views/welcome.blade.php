<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Aplikasi Absensi PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/logo absensipkl.png') }}" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans leading-relaxed tracking-normal">

    <!-- Header -->
    <header class="bg-white shadow-lg sticky top-0 z-50 transition duration-500 ease-in-out hover:shadow-2xl">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="text-3xl font-extrabold text-blue-600 tracking-wider hover:text-blue-700 transition duration-300">SI-PKL</div>
            <nav class="space-x-6">
                <a href="#features" class="text-gray-800 hover:text-blue-600 font-medium transition duration-300">Fitur</a>
                <a href="#about" class="text-gray-800 hover:text-blue-600 font-medium transition duration-300">Tentang</a>
                <a href="{{ route('login') }}" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2 rounded-full hover:from-blue-700 hover:to-indigo-700 transition duration-300">Masuk</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section dengan Background Gambar -->
    <section class="relative bg-gradient-to-r from-blue-500 to-indigo-500 text-white py-32 flex items-center">
        <div class="absolute inset-0 bg-cover bg-center opacity-40" style="background-image: url('{{ asset('assets/kelas.png') }}');"></div>
        <div class="container mx-auto px-6 text-center relative z-10">
            <h1 class="text-5xl md:text-7xl font-bold animate-fade-in">Selamat Datang di SI-PKL</h1>
            <p class="mt-6 text-lg md:text-2xl">Platform andal untuk melacak kehadiran dan perkembangan magang.</p>
            <a href="{{ route('login') }}" class="mt-10 bg-white text-blue-500 px-8 py-3 rounded-full text-lg font-semibold hover:bg-gray-100 transition duration-300 inline-block">Mulai Sekarang</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-gray-800">Fitur Utama</h2>
            <p class="mt-4 text-lg text-gray-600">Semua yang Anda butuhkan untuk mengelola kehadiran PKL dengan efektif.</p>

            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-2xl transition duration-500">
                    <div class="text-blue-700 mb-4">
                        <img src="{{ asset('assets/accept.png') }}" alt="Kehadiran Mudah" class="w-16 h-16 mx-auto">
                    </div>
                    <h3 class="text-2xl font-semibold text-blue-700">Kehadiran Mudah</h3>
                    <p class="mt-4 text-gray-600">Pencatatan kehadiran yang cepat dan mudah dengan QR code atau input manual.</p>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-2xl transition duration-500">
                    <div class="text-blue-700 mb-4">
                        <img src="{{ asset('assets/growth.png') }}" alt="Laporan Detail" class="w-16 h-16 mx-auto">
                    </div>
                    <h3 class="text-2xl font-semibold text-blue-700">Laporan Detail</h3>
                    <p class="mt-4 text-gray-600">Laporan lengkap tentang kehadiran, tugas, dan perkembangan secara keseluruhan.</p>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-2xl transition duration-500">
                    <div class="text-blue-700 mb-4">
                        <img src="{{ asset('assets/bell.png') }}" alt="Notifikasi Tepat Waktu" class="w-16 h-16 mx-auto">
                    </div>
                    <h3 class="text-2xl font-semibold text-blue-700">Notifikasi Tepat Waktu</h3>
                    <p class="mt-4 text-gray-600">Dapatkan pengingat untuk mencatat kehadiran dan mengirimkan laporan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="bg-gray-100 py-20">
        <div class="container mx-auto px-6 flex flex-col md:flex-row items-center">
            <div class="w-full md:w-1/2 mb-8">
                <img src="{{ asset('assets/foto lp.jpg') }}" alt="Tentang Kami" class="rounded-lg shadow-lg hover:shadow-2xl transition duration-500 w-full h-auto">
            </div>
            <div class="w-full md:w-1/2 md:pl-12 text-center md:text-left">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Tentang Kami</h2>
                <p class="text-lg text-gray-600 mb-4">Kami berkomitmen untuk menyediakan pengalaman yang lancar dalam mengelola kehadiran dan aktivitas PKL.</p>
                <p class="text-lg text-gray-600 mb-4">Platform kami dirancang untuk memenuhi kebutuhan magang dan administrator, memastikan setiap pihak memiliki alat yang dibutuhkan untuk sukses.</p>
                <div class="mt-6">
                    <a href="mailto:info@absensipkl.com" class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-full text-lg font-semibold hover:from-blue-700 hover:to-indigo-700 transition duration-300">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-6 text-center">
            <p class="mt-4">&copy; 2024 SI-PKL. Semua hak dilindungi.</p>
        </div>
    </footer>

</body>
</html>
