<?php

namespace Database\Seeders;

use App\Models\SaldoKas;
use App\Models\TransaksiKas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostDevelopmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement("INSERT INTO `supplier` (`id`, `nama`, `alamat`, `no_telp`, `hutang`, `created_at`, `updated_at`) VALUES
            (NULL, 'PT Global Pasifik Prima', 'Komplek Bahan Bangunan, JL. Arteri Jl. Mangga Dua Raya No.16 Blok F7, RT.17/RW.11, Mangga Dua Sel., Kecamatan Sawah Besar, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10730', '(021) 6011 758', 0, NOW(), NOW()),
            (NULL, 'CV Maju Jaya', 'Jl. Merpati No.12, Bandung, Jawa Barat', '081234567890', 0, NOW(), NOW()),
            (NULL, 'PT Sentosa Abadi', 'Jl. Rajawali No.5, Surabaya, Jawa Timur', '082134567891', 0, NOW(), NOW()),
            (NULL, 'Toko Sumber Rejeki', 'Jl. Gajah Mada No.23, Semarang, Jawa Tengah', '083134567892', 0, NOW(), NOW()),
            (NULL, 'UD Makmur Sentosa', 'Jl. Melati No.8, Yogyakarta', '084134567893', 0, NOW(), NOW()),
            (NULL, 'CV Cahaya Baru', 'Jl. Anggrek No.10, Depok, Jawa Barat', '085134567894', 0, NOW(), NOW()),
            (NULL, 'PT Sinar Mulya', 'Jl. Kenanga No.15, Bekasi, Jawa Barat', '086134567895', 0, NOW(), NOW()),
            (NULL, 'UD Tunas Harapan', 'Jl. Cendana No.6, Surakarta, Jawa Tengah', '087134567896', 0, NOW(), NOW()),
            (NULL, 'Toko Berkah Jaya', 'Jl. Kutilang No.4, Malang, Jawa Timur', '088134567897', 0, NOW(), NOW()),
            (NULL, 'CV Sumber Makmur', 'Jl. Nusa Indah No.11, Medan, Sumatera Utara', '089134567898', 0, NOW(), NOW()),
            (NULL, 'PT Indo Niaga', 'Jl. Cemara No.9, Palembang, Sumatera Selatan', '081234567899', 0, NOW(), NOW()),
            (NULL, 'CV Mandiri Abadi', 'Jl. Mawar No.3, Pontianak, Kalimantan Barat', '082234567800', 0, NOW(), NOW()),
            (NULL, 'UD Surya Utama', 'Jl. Dahlia No.7, Banjarmasin, Kalimantan Selatan', '083234567801', 0, NOW(), NOW()),
            (NULL, 'PT Bintang Timur', 'Jl. Flamboyan No.22, Balikpapan, Kalimantan Timur', '084234567802', 0, NOW(), NOW()),
            (NULL, 'CV Harapan Baru', 'Jl. Teratai No.18, Denpasar, Bali', '085234567803', 0, NOW(), NOW()),
            (NULL, 'Toko Laris Manis', 'Jl. Pahlawan No.2, Padang, Sumatera Barat', '086234567804', 0, NOW(), NOW()),
            (NULL, 'PT Alam Raya', 'Jl. Kamboja No.16, Manado, Sulawesi Utara', '087234567805', 0, NOW(), NOW()),
            (NULL, 'UD Sejahtera Bersama', 'Jl. Sudirman No.20, Makassar, Sulawesi Selatan', '088234567806', 0, NOW(), NOW()),
            (NULL, 'CV Indo Jaya', 'Jl. Veteran No.6, Pekanbaru, Riau', '089234567807', 0, NOW(), NOW()),
            (NULL, 'PT Mega Surya', 'Jl. Ahmad Yani No.30, Jambi', '081334567808', 0, NOW(), NOW()),
            (NULL, 'UD Prima Abadi', 'Jl. Diponegoro No.25, Palu, Sulawesi Tengah', '082334567809', 0, NOW(), NOW()),
            (NULL, 'Toko Gemilang', 'Jl. Sudirman No.13, Bengkulu', '083334567810', 0, NOW(), NOW()),
            (NULL, 'CV Mulya Abadi', 'Jl. Kalimantan No.5, Samarinda, Kalimantan Timur', '084334567811', 0, NOW(), NOW()),
            (NULL, 'PT Sarana Niaga', 'Jl. Sumatra No.10, Ternate, Maluku Utara', '085334567812', 0, NOW(), NOW()),
            (NULL, 'UD Mitra Usaha', 'Jl. Sulawesi No.8, Kupang, Nusa Tenggara Timur', '086334567813', 0, NOW(), NOW()),
            (NULL, 'Toko Sukses Jaya', 'Jl. Lombok No.9, Mataram, Nusa Tenggara Barat', '087334567814', 0, NOW(), NOW()),
            (NULL, 'CV Amanah Bersama', 'Jl. Bali No.4, Serang, Banten', '088334567815', 0, NOW(), NOW()),
            (NULL, 'PT Duta Mandiri', 'Jl. Papua No.6, Jayapura, Papua', '089334567816', 0, NOW(), NOW()),
            (NULL, 'UD Jaya Mulia', 'Jl. Maluku No.7, Ambon, Maluku', '081444567817', 0, NOW(), NOW()),
            (NULL, 'CV Bersama Maju', 'Jl. Batam No.12, Batam, Kepulauan Riau', '082444567818', 0, NOW(), NOW()),
            (NULL, 'Toko Sinar Harapan', 'Jl. Bangka No.3, Pangkal Pinang, Bangka Belitung', '083444567819', 0, NOW(), NOW()),
            (NULL, 'PT Berkat Usaha', 'Jl. Kalimantan No.17, Gorontalo', '084444567820', 0, NOW(), NOW())"
        );

        $saldoKas = SaldoKas::create([
            'cash' => 15000000,
            'hutang' => 0, 
            'date' => now()->format('Y-m-01'),
            'keterangan' => ''
        ]);
        
        TransaksiKas::create([
            ''
        ]);
    }
}
