<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BotReply;

class BotReplySeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        // Hapus data lama agar tidak duplikat
        BotReply::truncate();

        $replies = [
            // --- MENU UTAMA ---
            [
                'keyword' => '1',
                'title' => 'Info Surat',
                'type' => 'menu',
                'response_text' => "Anda memilih *Info Surat*.\n\n" .
                                 "Sebelum ke kantor desa, minta *surat pengantar* dari RT/RW dulu ya..\n\n" .
                                 "Pilih jenis surat:\n" .
                                 "11. KTP (Kartu Tanda Penduduk)\n" .
                                 "12. KK (Kartu Keluarga)\n" .
                                 "13. Akta Lahir\n" .
                                 "14. Akta Mati\n" .
                                 "15. SKCK (Surat Keterangan Catatan Kepolisian)\n" .
                                 "16. Mengajukan Pindah\n" .
                                 "17. Legalisasi (Nikah, Talak, Cerai, Rujuk)",
            ],
            [
                'keyword' => '2',
                'title' => 'Alamat Kantor & Jam Buka',
                'type' => 'info',
                'response_text' => "Kantor Desa beralamat di Jl. Raya Dono.\n\n" .
                                 "Jam Buka: \n*Senin - Kamis, 08:00 - 12:00 WIB.*\n" .
                                 "*Jum'at, 08:00 - 10:00 WIB.*\n\n" .
                                 "Link Google Maps:\n" .
                                 "https://maps.app.goo.gl/Gux9LvrBTmGc13DfA",
            ],
            [
                'keyword' => '3',
                'title' => 'Kontak & Kritik Saran',
                'type' => 'info',
                'response_text' => "Untuk urusan administrasi, hubungi [...]\n\n" .
                                 "Untuk Kritik & Saran, silakan isi formulir:\n" .
                                 "https://forms.gle/...",
            ],

            // --- SUB-MENU SURAT ---
            [
                'keyword' => '11',
                'title' => 'Prosedur KTP',
                'type' => 'info',
                'response_text' => "Informasi Prosedur untuk *Mengurus KTP* adalah sebagai berikut:\n" .
                                 "- Surat Pengantar dari RT/RW\n" .
                                 "- Formulir permohonan KTP (FS 03)\n" .
                                 "- Surat Kehilangan dari Kepolisian (bagi KTP yang hilang)\n" .
                                 "- KTP dan KK asli jika ada perubahan\n" .
                                 "- Foto copy Akta, Ijazah bagi yang rekam data biometrik\n" .
                                 "- Foto copy KK\n" .
                                 "- Seluruh proses pengurusan KTP dapat dilakukan langsung di Kantor Kecamatan Karangrejo.\n"
            ],
            [
                'keyword' => '12',
                'title' => 'Prosedur KK',
                'type' => 'info',
                'response_text' => "Informasi Prosedur untuk *Mengurus KK (Kartu Keluarga)* adalah sebagai berikut:\n" .
                                 "- Surat Pengantar dari RT/RW\n" .
                                 "- Surat Pengantar dari Desa/Kelurahan\n" .
                                 "- Formulir Pendaftaran KTP (FS 01)\n" .
                                 "- Formulir Biodata (FS 02)\n" .
                                 "- Foto copy Surat Nikah\n" .
                                 "- Foto copy Akta Lahir\n" .
                                 "- Foto copy Ijazah\n" .
                                 "- Surat Pernyataan bagi yang KK hilang\n" .
                                 "- Surat Pindah dari daerah asal, bagi pendatang\n" .
                                 "- Surat Kelahiran untuk penambahan anak",
            ],
            [
                'keyword' => '13',
                'title' => 'Prosedur Akta Lahir',
                'type' => 'info',
                'response_text' => "Informasi Prosedur untuk *Mengurus Akta Lahir* adalah sebagai berikut:\n" .
                                 "- Surat Pengantar dari RT/RW\n" .
                                 "- Surat Pengantar dari Desa/Kelurahan\n" .
                                 "- Foto copy KTP orang tua\n" .
                                 "- Foto copy KTP 2 orang saksi\n" .
                                 "- Foto copy dan asli Kartu Keluarga (KK)\n" .
                                 "- Foto copy Buku Nikah\n" .
                                 "- Surat Kelahiran dari Dokter/Bidan",
            ],
            [
                'keyword' => '14',
                'title' => 'Prosedur Akta Mati',
                'type' => 'info',
                'response_text' => "Informasi Prosedur untuk *Mengurus Akta Mati* adalah sebagai berikut:\n" .
                                 "- Surat Pengantar dari RT/RW\n" .
                                 "- Surat Pengantar dari Desa/Kelurahan\n" .
                                 "- KTP dan KK yang bersangkutan\n" .
                                 "- Foto copy KTP 2 orang saksi\n" .
                                 "- Surat Kematian dari Dokter apabila ada",
            ],
            [
                'keyword' => '15',
                'title' => 'Prosedur SKCK',
                'type' => 'info',
                'response_text' => "Informasi Prosedur untuk *Mengurus SKCK* adalah sebagai berikut:\n" .
                                 "- Surat Pengantar dari RT/RW\n" .
                                 "- Surat Pengantar dari Desa/Kelurahan\n" .
                                 "- Foto copy KTP dan KK\n" .
                                 "- Foto copy Akta lahir dan Ijazah\n" .
                                 "- Pas foto 4x6 berwarna background merah 5 lembar",
            ],
            [
                'keyword' => '16',
                'title' => 'Prosedur Mengajukan Pindah',
                'type' => 'info',
                'response_text' => "Informasi Prosedur untuk *Mengajukan Pindah* adalah sebagai berikut:\n" .
                                 "- Surat Pengantar dari RT/RW\n" .
                                 "- Surat Pengantar dari Desa/Kelurahan\n" .
                                 "- Formulir permohonan pindah\n" .
                                 "- KTP dan KK asli\n" .
                                 "- Foto copy Surat Nikah\n" .
                                 "- Pas foto 4x6 berwarna 4 lembar bagi pemohon pindah, bukan pengikut pindah\n" .
                                 "- SKCK bagi yang pindah keluar Kabupaten/Kota/Provinsi",
            ],
            [
                'keyword' => '17',
                'title' => 'Prosedur Legalisasi',
                'type' => 'info',
                'response_text' => "Informasi Prosedur untuk *Legalisasi (Nikah, Talak, Cerai, Rujuk)* adalah sebagai berikut:\n" .
                                 "- Surat Pengantar dari RT/RW\n" .
                                 "- Surat Pengantar dari Desa/Kelurahan\n" .
                                 "- Formulir N1 - N7 dari KUA bagi yang beragama Islam\n" .
                                 "- Rujukan dari KUA asal bagi mempelai dari luar Kecamatan\n" .
                                 "- Surat Permohonan Perkawinan dari gereja/Pendeta bagi yang Non Muslim\n" .
                                 "- Foto copy Akta Lahir, Ijazah, Surat Nikah Orangtua",
            ],
        ];

        // Masukkan data ke database
        foreach ($replies as $reply) {
            BotReply::create($reply);
        }
    }
}
