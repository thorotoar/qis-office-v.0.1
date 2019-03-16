<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\JurusanPendidikan;

class jurusanPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($c = 0; $c < 3; $c++){
            $jurusan_pendidikan = JurusanPendidikan::create([
                'nama_jurusan_pendidikan' => $faker->sentence('5', 'true'),
                'created_by' => '',
                'updated_by' => '',
            ]);
        }

        JurusanPendidikan::find(1)->update([
            'nama_jurusan_pendidikan' => 'Teknik Informatika',
        ]);

        JurusanPendidikan::find(2)->update([
            'nama_jurusan_pendidikan' => 'Ilmu Komunikasi',
        ]);

        JurusanPendidikan::find(3)->update([
            'nama_jurusan_pendidikan' => 'Ilmu Hukum',
        ]);
    }
}
