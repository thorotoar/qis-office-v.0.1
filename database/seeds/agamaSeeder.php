<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Agama;

class agamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($c = 0; $c < 5; $c++){
            $agama = Agama::create([
                'nama_agama' => $faker->sentence(1, true),
            ]);
        }

        Agama::find(1)->update([
          'nama_agama' => 'Islam',
        ]);

        Agama::find(2)->update([
            'nama_agama' => 'Kristen',
        ]);

        Agama::find(3)->update([
            'nama_agama' => 'Hindu',
        ]);

        Agama::find(4)->update([
            'nama_agama' => 'Budha',
        ]);

        Agama::find(5)->update([
            'nama_agama' => 'Katholik',
        ]);
    }
}
