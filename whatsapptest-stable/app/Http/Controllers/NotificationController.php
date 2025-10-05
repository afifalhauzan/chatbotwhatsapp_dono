<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MissaelAnda\Whatsapp\Facade\Whatsapp;
use MissaelAnda\Whatsapp\Messages\TextMessage; // Atau TemplateMessage jika Anda punya
use Illuminate\Support\Facades\Log;
use MissaelAnda\Whatsapp\Messages;

class NotificationController extends Controller
{
    /**
     * Menangani data yang masuk dari Google Form.
     */
    public function handleFormSubmission(Request $request, string $secret)
    {
        // 1. Verifikasi Kunci Rahasia
        $ourSecret = env('FORM_SUBMISSION_SECRET');
        if (!$ourSecret || $secret !== $ourSecret) {
            // Jika kunci rahasia salah atau tidak di-set, tolak akses.
            return response()->json(['status' => 'error', 'message' => 'Akses ditolak'], 403);
        }

        // 2. Ambil data dari request
        $formData = $request->all();
        $operatorNumber = env('OPERATOR_WA_NUMBER');
        $operatorNumber2 = env('OPERATOR_WA_NUMBER2');

        if (!$operatorNumber || !$operatorNumber2) {
            // Jika nomor operator tidak di-set, hentikan.
            return response()->json(['status' => 'error', 'message' => 'Nomor WhatsApp operator tidak diatur'], 500);
        }

        // 3. Format semua data form menjadi SATU string untuk variabel template
        $formSummaryLines = [];
        foreach ($formData as $question => $answer) {
            $formattedQuestion = ucwords(str_replace('_', ' ', $question));
            // Format: "Nama Lengkap: Budi Santoso"
            $formSummaryLines[] = $formattedQuestion . ": " . ($answer ?: '-');
        }
        $formSummary = implode(" | ", $formSummaryLines);

        // 4. Kirim notifikasi ke nomor operator menggunakan Template Message
        try {

            Log::info('Mencoba mengirim template dengan body:', ['summary' => $formSummary]);

            $templateMessage = Messages\TemplateMessage::create()
                // Ganti 'notifikasi_form_sederhana' dengan nama template Anda yang sebenarnya
                ->name('formbaru')
                ->language('id')
                // ->body([
                //     // Masukkan rangkuman form sebagai parameter pertama (untuk {{1}})
                //     // Text::create($formSummary)]
                //     Parameters\Text::create('123456')
                // );

                ->body(Messages\Components\Body::create([
                    Messages\Components\Parameters\Text::create($formSummary),
                ]));

            Log::info('Payload lengkap yang akan dikirim:', [
                'to' => $operatorNumber,
                'payload_object' => $templateMessage->toArray() // Mengubah objek pesan menjadi array
            ]);

            Whatsapp::send($operatorNumber, $templateMessage);
            Whatsapp::send($operatorNumber2, $templateMessage);
        } catch (\Exception $e) {
            // Jika pengiriman gagal, catat error
            Log::error('Gagal mengirim notifikasi WA via Template: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal mengirim notifikasi'], 500);
        }

        // 5. Beri respons sukses
        return response()->json(['status' => 'success']);
    }
}
