<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use MissaelAnda\Whatsapp\Events\MessagesReceived;
use MissaelAnda\Whatsapp\Facade\Whatsapp;
use MissaelAnda\Whatsapp\Messages;
use MissaelAnda\Whatsapp\Messages\TextMessage;
use App\Models\BotReply;
use Illuminate\Support\Facades\Cache;



class ReplyToWhatsappMessage
{
    /**
     * Metode utama yang menangani event.
     */
    public function handle(MessagesReceived $event): void
    {
        $payload = $event->data;
        if (empty($payload['messages'])) {
            return;
        }

        $message = $payload['messages'][0];
        $senderNumber = $message['from'];

        // --- 2. Implementasi Rate Limiting Sederhana ---
        $cacheKey = 'rate_limit_' . $senderNumber;
        
        // Cek berapa kali nomor ini mengirim pesan dalam 1 menit terakhir
        $requestCount = Cache::get($cacheKey, 0);

        if ($requestCount >= 10) {
            // Jika sudah 10 kali atau lebih, abaikan pesan ini.
            Log::warning("Rate limit terlampaui untuk nomor: " . $senderNumber);
            return; // Hentikan eksekusi
        }

        // Tambah hitungan. Durasi 60 detik akan di-reset setiap kali ada pesan baru.
        Cache::put($cacheKey, $requestCount + 1, 60); // 60 detik = 1 menit
        // --- Akhir dari Rate Limiting ---


        // Hanya proses jika tipenya teks
        if ($message['type'] == 'text') {
            // Ambil teks, ubah ke huruf kecil, dan hapus spasi berlebih
            $incomingText = strtolower(trim($message['text']['body']));

            $this->handleLogic($senderNumber, $incomingText);
        }
    }

    /**
     * Menangani semua logika balasan berdasarkan input teks/angka.
     */
    private function handleLogic(string $senderNumber, string $text): void
    {
        $replyText = '';

        $mainMenuText = "\n\n" .
            "--------------------\n" .
            "Ketik *angka* untuk memilih opsi lain:\n" .
            "1. Info Surat\n" .
            "2. Alamat Kantor & Jam Buka\n" .
            "3. Kontak & Kritik Saran";

        $menuTriggers = ['menu', 'halo', 'start', 'hi', 'hello'];
        if (in_array($text, $menuTriggers) || str_contains($text, 'informasi')) {
            $replyText = "Selamat Datang di Portal Informasi Desa Dono, Kec. Sendang, Kab. Tulungagung!\n\nKetik *angka* untuk memulai pilihan.\n\n1. Info Surat\n2. Alamat Kantor & Jam Buka\n3. Kontak & Kritik Saran";
            Whatsapp::send($senderNumber, TextMessage::create($replyText));
            return;
        }

        $botReply = BotReply::where('keyword', $text)->first();

        if ($botReply) {
            $replyText = $botReply->response_text;

            if ($botReply->type === 'info') {
                $replyText .= $mainMenuText;
            }
        } else {
            $replyText = "Maaf, pilihan tidak dikenali.\n\n_Pastikan pilihannya menggunakan angka._\n_Contoh \"1\" untuk Info Surat_" . $mainMenuText;
        }

        Whatsapp::send($senderNumber, TextMessage::create($replyText));
    }
}
