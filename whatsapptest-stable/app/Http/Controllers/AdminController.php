<?php

namespace App\Http\Controllers;

use App\Models\BotReply; // Jangan lupa impor model BotReply
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Menampilkan semua balasan bot yang bertipe 'info'.
     */
    public function showAllInformation()
    {
        // 1. Ambil semua data dari database
        //    di mana kolom 'type' adalah 'info'
        $informations = BotReply::where('type', 'info')->get();

        // 2. Kirim data tersebut ke sebuah view
        //    Kita akan membuat view ini di langkah berikutnya
        return view('admin.information-list', [
            'informations' => $informations
        ]);
    }
}
