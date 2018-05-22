<?php

use App\Model\Jenis;
use App\Model\Kategori;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jenis::truncate();
        Kategori::truncate();

        // jenis seed
        Jenis::create([
            'jenis_pengajuan' => 'PROJECT',
        ]);

        Jenis::create([
            'jenis_pengajuan' => 'NON-PROJECT',
        ]);

        // kategori seed
        Kategori::create([
            'kategori_pengajuan' => 'IMBAS PETIR',
            'jenis_id' => '1',
        ]);

        Kategori::create([
            'kategori_pengajuan' => 'PROJECT',
            'jenis_id' => '1',
        ]);

        Kategori::create([
            'kategori_pengajuan' => 'OPERATIONAL',
            'jenis_id' => '2',
        ]);
    }
}
