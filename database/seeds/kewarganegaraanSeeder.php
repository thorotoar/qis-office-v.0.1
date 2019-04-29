<?php

use Illuminate\Database\Seeder;
use App\Kewarganegaraan;

class kewarganegaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=\Faker\Factory::create('id_ID');

        for ($c = 0; $c < 242; $c++){
            Kewarganegaraan::create([
                'nama_negara' => $faker->country,
                'kode_negara' => $faker->countryCode,
            ]);
        }

//        $kewarganegaraan = Kewarganegaraan::create([
//            'nama_negara' => $faker->country,
//        ]);
    }
}
