<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\SuratMasuk;

class suratMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($c = 0; $c < 7; $c++){
            SuratMasuk::create([
                'user_id' => rand(\App\User::min('id'), \App\User::max('id')),
                'no_surat' => $faker->numerify('###'),
                'tgl_diterima' => $faker->date(),
                'tgl_dicatat' => $faker->date(),
                'pengirim' => $faker->company,
                'penerima' => $faker->name,
                'prihal' => $faker->text,
                'upload_file' => $faker->imageUrl('84', '112'),
                'created_by' => '',
                'updated_by' => '',
            ]);
        }
    }
}
