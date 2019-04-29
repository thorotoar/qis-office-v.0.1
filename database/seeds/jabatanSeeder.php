<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Jabatan;

class jabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($c = 0; $c < 13; $c++){
            Jabatan::create([
                'nama_jabatan' => $faker->sentence('1', 'true'),
                'lembaga_id' => rand(\App\Lembaga::min('id'), \App\Lembaga::max('id')),
                'created_by' => '',
                'updated_by' => '',
            ]);
        }

        Jabatan::find(1)->update([
            'kode_jabatan' => 'DRK',
            'nama_jabatan' => 'Direktur Quali International Surabaya',
            'lembaga_id' => '1',
        ]);

        Jabatan::find(2)->update([
            'kode_jabatan' => 'MNG',
            'nama_jabatan' => 'General Manager',
            'lembaga_id' => '1',
        ]);

        Jabatan::find(3)->update([
            'kode_jabatan' => 'MNO',
            'nama_jabatan' => 'Manager Operasional',
            'lembaga_id' => '1',
        ]);

        Jabatan::find(4)->update([
            'kode_jabatan' => 'MRK',
            'nama_jabatan' => 'Marketing',
            'lembaga_id' => '1',
        ]);

        Jabatan::find(5)->update([
            'kode_jabatan' => 'PNG',
            'nama_jabatan' => 'Bagian Pengajaran',
            'lembaga_id' => '1',
        ]);

        Jabatan::find(6)->update([
            'kode_jabatan' => 'BND',
            'nama_jabatan' => 'Bagian Bendahara',
            'lembaga_id' => '1',
        ]);

        Jabatan::find(7)->update([
            'kode_jabatan' => 'ADM',
            'nama_jabatan' => 'Bagian Administrasi',
            'lembaga_id' => '1',
        ]);

        Jabatan::find(8)->update([
            'kode_jabatan' => 'INS',
            'nama_jabatan' => 'Instruktur',
            'lembaga_id' => '2',
        ]);

        Jabatan::find(9)->update([
            'kode_jabatan' => 'PMP',
            'nama_jabatan' => 'Pimpinan',
            'lembaga_id' => '2',
        ]);

        Jabatan::find(10)->update([
            'kode_jabatan' => 'KPG',
            'nama_jabatan' => 'Konsultan Psikolog',
            'lembaga_id' => '4',
        ]);

        Jabatan::find(11)->update([
            'kode_jabatan' => 'KPK',
            'nama_jabatan' => 'Konsultan Pendidik',
            'lembaga_id' => '4',
        ]);

        Jabatan::find(12)->update([
            'kode_jabatan' => 'DKU',
            'nama_jabatan' => 'Dokter Umum',
            'lembaga_id' => '4',
        ]);

        Jabatan::find(13)->update([
            'kode_jabatan' => 'DKG',
            'nama_jabatan' => 'Dokter Gigi',
            'lembaga_id' => '4',
        ]);

    }
}
