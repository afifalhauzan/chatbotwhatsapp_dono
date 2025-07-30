<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BotReply;
use Illuminate\Http\Request;

class BotReplyController extends Controller
{
    /**
     * Menampilkan daftar semua balasan bot.
     */
    public function index()
    {
        $replies = BotReply::orderBy('keyword')->paginate(15);
        return view('admin.bot_replies.index', compact('replies'));
    }

    /**
     * Menampilkan form untuk membuat balasan baru.
     */
    public function create()
    {
        return view('admin.bot_replies.create');
    }

    /**
     * Menyimpan balasan baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'keyword' => 'required|string|max:255|unique:bot_replies',
            'title' => 'required|string|max:255',
            'response_text' => 'required|string',
            'type' => 'required|in:menu,info',
        ]);

        BotReply::create($validated);

        return redirect()->route('admin.bot_replies.index')
                         ->with('success', 'Balasan baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit balasan. (Metode Manual)
     */
    public function edit(string $keyword)
    {
        // Cari data secara manual berdasarkan 'keyword'.
        // firstOrFail() akan otomatis menampilkan 404 jika tidak ditemukan.
        $botReply = BotReply::where('keyword', $keyword)->firstOrFail();
        
        return view('admin.bot_replies.edit', compact('botReply'));
    }

    /**
     * Memperbarui balasan di database. (Metode Manual)
     */
    public function update(Request $request, string $keyword)
    {
        $botReply = BotReply::where('keyword', $keyword)->firstOrFail();

        $validated = $request->validate([
            'keyword' => 'required|string|max:255|unique:bot_replies,keyword,' . $botReply->id,
            'title' => 'required|string|max:255',
            'response_text' => 'required|string',
            'type' => 'required|in:menu,info',
        ]);

        $botReply->update($validated);

        return redirect()->route('admin.bot_replies.index')
                         ->with('success', 'Balasan berhasil diperbarui.');
    }

    /**
     * Menghapus balasan dari database. (Metode Manual)
     */
    public function destroy(string $keyword)
    {
        $botReply = BotReply::where('keyword', $keyword)->firstOrFail();
        $botReply->delete();

        return redirect()->route('admin.bot_replies.index')
                         ->with('success', 'Balasan berhasil dihapus.');
    }
}
