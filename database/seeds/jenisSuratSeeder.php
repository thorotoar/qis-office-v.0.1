<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\JenisSurat;

class jenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($c = 0; $c < 11; $c++){
            JenisSurat::create([
                'nama_jenis_surat' => $faker->sentence('5', 'true'),
                'template_surat' => '',
                'lembaga_id' => rand(\App\Lembaga::min('id'), \App\Lembaga::max('id')),
                'template_konten' => '',
                'created_by' => '',
                'updated_by' => '',
            ]);
        }

        JenisSurat::find(1)->update([
            'nama_jenis_surat' => 'Surat Pemberitahuan',
            'template_surat' => 'Template 1',
            'lembaga_id' => '1',
        ]);

        JenisSurat::find(2)->update([
            'nama_jenis_surat' => 'Surat Penagihan',
            'template_surat' => 'Template 1',
            'lembaga_id' => '1',
        ]);

        JenisSurat::find(3)->update([
            'nama_jenis_surat' => 'Surat Peringatan',
            'template_surat' => 'Template 1',
            'lembaga_id' => '1',
        ]);

        JenisSurat::find(4)->update([
            'kode_surat' => 'PNG',
            'nama_jenis_surat' => 'Surat Pengajuan Dana',
            'template_surat' => 'Template 1',
            'lembaga_id' => '1',
        ]);

        JenisSurat::find(5)->update([
            'kode_surat' => 'SK',
            'nama_jenis_surat' => 'Surat Pengangkatan',
            'template_surat' => 'Template 2',
            'lembaga_id' => '1',
        ]);

        JenisSurat::find(6)->update([
            'nama_jenis_surat' => 'Surat Keterangan Pengalaman',
            'template_surat' => 'Template 2',
            'lembaga_id' => '1',
        ]);

        JenisSurat::find(7)->update([
            'nama_jenis_surat' => 'Surat Keputusan Penyusun Instruktur',
            'template_surat' => 'Template 2',
            'lembaga_id' => '1',
        ]);

        JenisSurat::find(8)->update([
            'nama_jenis_surat' => 'Surat Keputusan Penyusun Sylabus',
            'template_surat' => 'Template 2',
            'lembaga_id' => '1',
        ]);

        JenisSurat::find(9)->update([
            'nama_jenis_surat' => 'Surat Keputusan Penyusun RPP',
            'template_surat' => 'Template 2',
            'lembaga_id' => '1',
        ]);

        JenisSurat::find(10)->update([
            'nama_jenis_surat' => 'Test Template MDC',
            'template_surat' => 'Template 1',
            'lembaga_id' => '3',
        ]);

        JenisSurat::find(11)->update([
            'nama_jenis_surat' => 'Test Template MDC',
            'template_surat' => 'Template 2',
            'lembaga_id' => '4',
        ]);
    }
}
