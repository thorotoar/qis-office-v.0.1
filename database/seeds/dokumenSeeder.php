<?php

use Illuminate\Database\Seeder;
use App\Dokumen;
use Faker\Factory;

class dokumenSeeder extends Seeder
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
            Dokumen::create([
                'nama_dokumen' => $faker->sentence,
                'tgl_file' =>  $faker->date('Y-m-d','2000-01-01'),
                'tgl_dicatat' => $faker->date('Y-m-d','2000-01-01'),
                'keterangan' => $faker->text,
                'created_by' => '',
                'updated_by' => '',
            ]);
        }
    }
}
