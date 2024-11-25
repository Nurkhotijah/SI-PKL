@extends('components.layout-user')

@section('title', 'Profile Siswa')

@section('content')
<!-- Main Content -->
<div class="w-full p-4 flex-1">
            <div class="max-w-6xl mx-auto mt-10 bg-white rounded-lg shadow-md relative"> 
                <button class="absolute top-6 right-16 bg-yellow-400 text-white text-sm px-4 py-2 rounded-full shadow-lg hover:bg-yellow-500 transition duration-300 ease-in-out flex items-center transform hover:scale-105">
                    <a href="{{ route('profile.update') }}">
                        <i class="fas fa-edit mr-2"></i>
                        Edit
                    </a>
                </button>
                       
                <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="flex flex-col items-center py-8 px-8">
                        <!-- Bagian Profil -->
                        <div class="flex-shrink-0 mb-4 text-center relative">
                            <img id="profilePic" class="w-32 h-32 rounded-full border-4 border-blue-500" src="https://storage.googleapis.com/a1aa/image/NpzffnAyx0itC0ZeDvbqORYoeo8o3rWaXVQuaJVSjitZ4BuOB.jpg" alt="Profile Picture">
                            <input type="file" id="fileInput" class="hidden" onchange="changePhoto()">
                        </div>
                        <!-- Info Dasar di Sebelah Profil -->
                        <div class="w-full text-center">
                            <h2 class="text-2xl font-semibold text-gray-800 mb-1">{{ Auth::user()->name }}</h2>
                            <p class="text-gray-600 mb-4">Siswa</p>
                            <!-- Informasi Profil Pengguna dengan Border Rapi -->
                            <div class="border border-gray-300 rounded-lg mb-6">
                                <h3 class="bg-blue-500 text-white p-4 font-semibold text-center rounded-t-lg">Informasi Profil Pengguna</h3>
                                <div class="grid grid-cols-2 gap-x-8 gap-y-2 text-gray-700 p-4 rounded-b-lg text-left">
                                    <p class="font-sans"><span class="font-medium">Nama Lengkap:</span> {{ Auth::user()->name }}</p>
                                    <p class="font-sans"><span class="font-medium">NIS:</span> 1092</p>
                                    <p class="font-sans"><span class="font-medium">Kelas:</span> XII PPLG 3</p>
                                    <p class="font-sans"><span class="font-medium">Tempat Lahir:</span> CityB</p>
                                    <p class="font-sans"><span class="font-medium">Tanggal Lahir:</span> 2007-12-07</p>
                                    <p class="font-sans"><span class="font-medium">Gender:</span> Female</p>
                                    <p class="font-sans"><span class="font-medium">Alamat:</span> 390 Road</p>
                                </div>
                            </div>
                            <!-- Informasi Tempat PKL dan Data Pembimbing Sekolah -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                                <div class="border border-gray-300 rounded-lg">
                                    <h3 class="bg-blue-500 text-white p-4 font-semibold text-center rounded-t-lg">Informasi Tempat PKL</h3>
                                    <div class="p-4 text-left">
                                        <p class="font-sans"><span class="font-medium">Nama Tempat PKL:</span> PT ABC</p>
                                        <p class="font-sans"><span class="font-medium">Bidang:</span> Teknologi Informasi</p>
                                        <p class="font-sans"><span class="font-medium">Alamat:</span> Jl. PKL No.123</p>
                                        <p class="font-sans"><span class="font-medium">Nama Pembimbing:</span> John Doe</p>
                                        <p class="font-sans"><span class="font-medium">No Telepon Pembimbing:</span> 08123456789</p>
                                    </div>
                                </div>
                                <div class="border border-gray-300 rounded-lg">
                                    <h3 class="bg-blue-500 text-white p-4 font-semibold text-center rounded-t-lg">Data Pembimbing Sekolah</h3>
                                    <div class="p-4 text-left">
                                        <p class="font-sans"><span class="font-medium">Nama Pembimbing 1:</span> Mr. Smith</p>
                                        <p class="font-sans"><span class="font-medium">Nama Pembimbing 2:</span> Ms. Johnson</p>
                                        <p class="font-sans"><span class="font-medium">No Telepon Pembimbing 1:</span> 08987654321</p>
                                        <p class="font-sans"><span class="font-medium">No Telepon Pembimbing 2:</span> 08912345678</p>
                                    </div>
                                </div>
                            </div>      
                          <!-- <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex flex-col border border-gray-300 rounded-lg">
                                    <h3 class="font-semibold text-lg mb-2 text-center p-4 bg-blue-500 text-white rounded-t-lg">Tempat PKL</h3>
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.612413793621!2d106.74005677410136!3d-6.570503664228493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69dc9b2bd7bc0f%3A0x3fff29cf02995e70!2sPT%20Qelopak%20Teknologi%20Indonesia!5e0!3m2!1sid!2sid!4v1730186289091!5m2!1sid!2sid"
                                        width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                                <div class="flex flex-col border border-gray-300 rounded-lg">
                                    <h3 class="font-semibold text-lg mb-2 text-center p-4 bg-blue-500 text-white rounded-t-lg">Sekolah</h3>
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.489466999512!2d106.75623947410159!3d-6.585915564378621!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5457e0e3bcf%3A0x58481d58737539c0!2sSMK%20Negeri%201%20Ciomas!5e0!3m2!1sid!2sid!4v1730186447824!5m2!1sid!2sid"
                                        width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
        </main>
         
    <script>
        function changePhoto() {
            const fileInput = document.getElementById('fileInput');
            const reader = new FileReader();

            if (fileInput.files && fileInput.files[0]) {
                reader.onload = function (e) {
                    document.getElementById('profilePic').src = e.target.result;
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
@endsection
