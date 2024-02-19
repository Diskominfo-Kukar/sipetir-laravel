<?php

namespace Database\Seeders;

use App\Models\Master\KategoriReview;
use App\Models\Master\Question;
use Illuminate\Database\Seeder;

class DataKategoriSeedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $katgeori = [
            'Review Kebijakan Umum Pengadaan',
            'Review Dokumen Anggaran Belanja',
            'Review Kerangka Acuan Kerja (KAK)',
            'Review Harga Perkiraan Sendiri (HPS)',
            'Review Rancangan Kontrak/Perjanjian',
            'Lain-Lain',
        ];
        $quetion = [
            [
                'nama'        => 'Apakah pemaketan mendorong persaingan sehat?',
                'kategori_id' => 'Review Kebijakan Umum Pengadaan',
            ],
            [
                'nama'        => 'Apakah pemaketan akan lebihefisien jika diproses melalui Seleksi?',
                'kategori_id' => 'Review Kebijakan Umum Pengadaan',
            ],
            [
                'nama'        => 'Apakah pemaketan meningkatkan peran Usaha Mikro / Kecil?',
                'kategori_id' => 'Review Kebijakan Umum Pengadaan',
            ],
            [
                'nama'        => 'Apakah pemaketan mendukung penggunaan produksi dalam negeri?',
                'kategori_id' => 'Review Kebijakan Umum Pengadaan',
            ],
            [
                'nama'        => 'Apakah kode rekening yang tercantum dalam dokumen pelaksanaan anggaran (DPA) sesuai dengan peruntukan dan jenis pengeluaran?',
                'kategori_id' => 'Review Dokumen Anggaran Belanja',
            ],
            [
                'nama'        => 'Apakah perkiraan jumlah anggaran yang tersedia untuk paket pekerjaan dalam dokumen pelaksanaan anggaran (DPA) mencukupikebutuhan pelaksanaan pekerjaan?',
                'kategori_id' => 'Review Dokumen Anggaran Belanja',
            ],
            [
                'nama'        => 'Apakah tersedia Honorarium Pokja dokumen pelaksanaan anggaran (DPA)?',
                'kategori_id' => 'Review Dokumen Anggaran Belanja',
            ],
            [
                'nama'        => 'Apakah tersedia biaya pendukung pelaksanaan pengadaan (Klarifikasi Lapangan/Pembuktian Kualifikasi/Survei Lapangan) dokumen pelaksanaan anggaran (DPA)?',
                'kategori_id' => 'Review Dokumen Anggaran Belanja',
            ],
            [
                'nama'        => 'Apakah KAK sudah menjelaskan latar belakang kegiatan/pengadaan yang akan dilaksanakan?',
                'kategori_id' => 'Review Kerangka Acuan Kerja (KAK)',
            ],
            [
                'nama'        => 'Apakah KAK sudah menjelaskan maksud dan tujuan kegiatan/ pengadaan yang akan dilaksanakan?',
                'kategori_id' => 'Review Kerangka Acuan Kerja (KAK)',
            ],
            [
                'nama'        => 'Apakah KAK sudah menjelaskan maksud dan tujuan kegiatan/ pengadaan yang akan dilaksanakan?',
                'kategori_id' => 'Review Kerangka Acuan Kerja (KAK)',
            ],
            [
                'nama'        => 'Apakah KAK sudah menjelaskan lokasi kegiatan/ pengadaan yang akan dilaksanakan?',
                'kategori_id' => 'Review Kerangka Acuan Kerja (KAK)',
            ],
            [
                'nama'        => 'Apakah KAK sudah menjelaskan ruang lingkup kegiatan/ pengadaan yang akan dilaksanakan?',
                'kategori_id' => 'Review Kerangka Acuan Kerja (KAK)',
            ],
            [
                'nama'        => 'Apakah KAK sudah menjelaskan keluaran yang yang dibutuhkan dari kegiatan/ pengadaan yang akan dilaksanakan?',
                'kategori_id' => 'Review Kerangka Acuan Kerja (KAK)',
            ],
            [
                'nama'        => 'Apakah KAK sudah menjelaskan sumber pendanaan dan perkiraan biaya kegiatan/ pengadaan yang akan dilaksanakan?',
                'kategori_id' => 'Review Kerangka Acuan Kerja (KAK)',
            ],
            [
                'nama'        => 'Apakah KAK sudah menjelaskan waktu pelaksanaan yang diperlukan?',
                'kategori_id' => 'Review Kerangka Acuan Kerja (KAK)',
            ],
            [
                'nama'        => 'Apakah KAK sudah menjelaskanjenis, isi dan jumlahlaporan yang harus dibuat?',
                'kategori_id' => 'Review Kerangka Acuan Kerja (KAK)',
            ],
            [
                'nama'        => 'Apakah KAK sudah menjelaskankebutuhan organisasi pengadaan dan jumlah tenaga yang diperlukan?',
                'kategori_id' => 'Review Kerangka Acuan Kerja (KAK)',
            ],
            [
                'nama'        => 'Apakah KAK sudah menjelaskanhal-hal khusus yang perlu dijelaskan, seperti syarat khusus penyedia (bila perlu) !',
                'kategori_id' => 'Review Kerangka Acuan Kerja (KAK)',
            ],
            [
                'nama'        => 'Apakah KAK sudah menjelaskanhal-hal khusus yang perlu dijelaskan, seperti syarat khusus alat dan bahan (bila perlu) !',
                'kategori_id' => 'Review Kerangka Acuan Kerja (KAK)',
            ],
            [
                'nama'        => 'Apakah KAK sudah menjelaskanhal-hal khusus yang perlu dijelaskan, seperti syarat khusus tenaga ahli (bila perlu) !',
                'kategori_id' => 'Review Kerangka Acuan Kerja (KAK)',
            ],
            [
                'nama'        => 'Apakah sumber data/informasi yang dipergunakan dalam menetapkan HPS?',
                'kategori_id' => 'Review Harga Perkiraan Sendiri (HPS)',
            ],
            [
                'nama'        => 'Apakah terdapat kalkulasi / perhitungan khusus dalam menetapkan nilai HPS?',
                'kategori_id' => 'Review Harga Perkiraan Sendiri (HPS)',
            ],
            [
                'nama'        => 'Apakah HPS sudah memperhitungkan perpajakan?',
                'kategori_id' => 'Review Harga Perkiraan Sendiri (HPS)',
            ],
            [
                'nama'        => 'Apakah masa penetapan HPS telah memenuhi ketentuan pengadaan?',
                'kategori_id' => 'Review Harga Perkiraan Sendiri (HPS)',
            ],
            [
                'nama'        => 'Apakah terdapat dokumentasi/riwayat penyusunan HPS?',
                'kategori_id' => 'Review Harga Perkiraan Sendiri (HPS)',
            ],
            [
                'nama'        => 'Apakah HPS sudah ditandatangani oleh PPK?',
                'kategori_id' => 'Review Harga Perkiraan Sendiri (HPS)',
            ],
            [
                'nama'        => 'Apa standar dokumen rancangan kontrak / perjanjian yang dipergunakan (SPK atau Surat Perjanjian)?',
                'kategori_id' => 'Review Rancangan Kontrak/Perjanjian',
            ],
            [
                'nama'        => 'Apakah jenis kontrak yang dipergunakan sesuai dengan karakteristik pengadaan?',
                'kategori_id' => 'Review Rancangan Kontrak/Perjanjian',
            ],
            [
                'nama'        => 'Apakah bukti perjanjian yang dipergunakan sesuai dengan nilai pengadaan?',
                'kategori_id' => 'Review Rancangan Kontrak/Perjanjian',
            ],
            [
                'nama'        => 'Apakah klausul yang harus diisi dalam rancangan kontrak / perjanjian telah dipenuhi (seperti : jenis kontrak, sanksi, pembayaran prestasi kerja, uang muka, dll) ?',
                'kategori_id' => 'Review Rancangan Kontrak/Perjanjian',
            ],
            [
                'nama'        => 'Dalam menyusun rancangan kontrak,  Syarat -Syarat Umum Kontrak (SSUK), Pelaksanaan Kontrak, Penyelesaian Kontrak, Adendum Kontrak, Pemutusan Kontrak, Hak dan Kewajiban Para Pihak, Personil dan/ Atau Peralatan Penyedia, Pembayaran Kepada Penyedia, Pengawasan Mutu, serta Syarat- Syarat Khusus Kontrak (SSKK) sudah sesuai dengan kebutuhan pelaksanaan pekerjaan?\r\n',
                'kategori_id' => 'Review Rancangan Kontrak/Perjanjian',
            ],
            [
                'nama'        => 'Apakah rancangan kontrak / perjanjian sudah representatif untuk menjadi bagian dokumen pengadaan?',
                'kategori_id' => 'Review Rancangan Kontrak/Perjanjian',
            ],
            [
                'nama'        => 'Pertanyaan lain-lain',
                'kategori_id' => 'Lain-Lain',
            ],

        ];
        $no_urut_kat = 0;

        foreach ($katgeori as $kt) {
            $kategori = KategoriReview::updateOrCreate([
                'nama'    => $kt,
                'no_urut' => $no_urut_kat++,
            ]);

            foreach ($quetion as $key => $qt) {
                if ($qt['kategori_id'] == $kt) {
                    $no_urut_qt = 0;
                    Question::updateOrCreate(
                        [
                            'kategori_id' => $kategori->id,
                            'nama'        => ucfirst($qt['nama']),
                            'no_urut'     => $no_urut_qt++,
                        ]
                    );
                }
            }
        }
    }
}
