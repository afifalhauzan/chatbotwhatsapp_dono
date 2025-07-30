.<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Informasi Bot - Admin Panel</title>
    {{-- Memuat Tailwind CSS dari CDN untuk kemudahan --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Daftar Informasi Bot</h1>
            <p class="mt-1 text-gray-600">Berikut adalah semua balasan akhir (tipe 'info') yang ada di sistem.</p>
        </header>

        <main class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Loop untuk setiap data informasi yang dikirim dari controller --}}
            @forelse ($informations as $info)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        {{-- Menampilkan Judul --}}
                        <div class="uppercase tracking-wide text-sm text-indigo-600 font-semibold">{{ $info->title }}</div>
                        <p class="block mt-1 text-lg leading-tight font-medium text-black">Keyword: {{ $info->keyword }}</p>
                        
                        <hr class="my-4">
                        
                        {{-- Menampilkan Isi Pesan --}}
                        {{-- 
                            Menggunakan {!! !!} dan nl2br() agar karakter newline (\n) 
                            di database berubah menjadi tag <br> di HTML, 
                            sehingga formatnya tetap rapi.
                        --}}
                        <p class="mt-2 text-gray-600 whitespace-pre-line">
                            {!! nl2br(e($info->response_text)) !!}
                        </p>
                    </div>
                </div>
            @empty
                {{-- Tampilan jika tidak ada data sama sekali --}}
                <div class="col-span-full bg-white rounded-xl shadow p-6 text-center">
                    <p class="text-gray-500">Tidak ada data informasi yang ditemukan di database.</p>
                </div>
            @endforelse
        </main>

        <footer class="text-center mt-12 text-sm text-gray-500">
            <p>Admin Panel Chatbot Desa</p>
        </footer>
    </div>

</body>
</html>
