<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Balasan Bot</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Kelola Balasan Bot</h1>
                <p class="mt-1 text-gray-600">Tambah, edit, atau hapus balasan otomatis untuk chatbot.</p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.bot_replies.create') }}" class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-indigo-700 transition-colors">
                    + Tambah Balasan Baru
                </a>
                <!-- Tombol Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-red-700 transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Keyword</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tipe</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($replies as $reply)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap font-mono bg-gray-100 px-2 py-1 rounded inline-block">{{ $reply->keyword }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $reply->title }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <span class="relative inline-block px-3 py-1 font-semibold leading-tight {{ $reply->type == 'info' ? 'text-green-900' : 'text-blue-900' }}">
                                <span aria-hidden class="absolute inset-0 {{ $reply->type == 'info' ? 'bg-green-200' : 'bg-blue-200' }} opacity-50 rounded-full"></span>
                                <span class="relative">{{ $reply->type }}</span>
                            </span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            <a href="{{ route('admin.bot_replies.edit', $reply) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                            <form action="{{ route('admin.bot_replies.destroy', $reply) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus balasan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 text-gray-500">Tidak ada data balasan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $replies->links() }}
        </div>
    </div>
</body>

</html>