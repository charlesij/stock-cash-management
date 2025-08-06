<?php

namespace Database\Seeders;

use App\Models\Akun;
use App\Models\SubAkun;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{

    public function run(): void
    {
        $subakunkas = Akun::create([
            'kode' => '1',
            'nama' => 'Kas',
            'jenis' => 1
        ]);

        SubAkun::create([
            'akun_id' => $subakunkas->id,
            'kode' => '001',
            'nama' => 'Kas'
        ]);
    
        $subakunhpp = Akun::create([
            'kode' => '2',
            'nama' => 'Harga pokok Penjualan(HPP)',
            'jenis' => 1
        ]);
        SubAkun::create([
            'akun_id' => $subakunhpp->id,
            'kode' => '001',
            'nama' => 'Beban Pokok Pendapatan'
        ]);

        $subakunHutang =Akun::create([
            'kode' => '3',
            'nama' => 'Hutang',
            'jenis' => 2
        ]);
        SubAkun::create([
            'akun_id' => $subakunHutang->id,
            'kode' => '001',
            'nama' => 'Hutang Usaha'
        ]);

        $subakunPendapatan = Akun::create([
            'kode' => '4',
            'nama' => 'Pendapatan',
            'jenis' => 2
        ]);
        SubAkun::create([
            'akun_id' => $subakunPendapatan->id,
            'kode' => '001',
            'nama' => 'Pendapatan'
        ]);

        $subakunBiaya = Akun::create([
            'kode' => '5',
            'nama' => 'Biaya',
            'jenis' => 1
        ]);
        SubAkun::create([
            'akun_id' => $subakunBiaya->id,
            'kode' => '001',
            'nama' => 'Biaya'
        ]);
    }
}
