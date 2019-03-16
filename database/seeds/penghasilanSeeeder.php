<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Penghasilan;

class penghasilanSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($c = 0; $c < 6; $c++){
            Penghasilan::create([
                'jumlah_penghasilan' => $faker->text,
            ]);
        }

        Penghasilan::find(1)->update([
            'jumlah_penghasilan' => 'Kurang dari Rp.500.000',
        ]);

        Penghasilan::find(2)->update([
            'jumlah_penghasilan' => 'Rp.500.000 - Rp.999.999',
        ]);

        Penghasilan::find(3)->update([
            'jumlah_penghasilan' => 'Rp.1.000.000 - Rp.1.999.999',
        ]);

        Penghasilan::find(4)->update([
            'jumlah_penghasilan' => 'Rp.2.000.000 - Rp.4.999.999',
        ]);

        Penghasilan::find(5)->update([
            'jumlah_penghasilan' => 'Rp.5.000.000 - Rp.20.000.000',
        ]);

        Penghasilan::find(6)->update([
            'jumlah_penghasilan' => 'Lebih dari Rp.20.000.000',
        ]);
    }
}
