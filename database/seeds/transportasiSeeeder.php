<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Transportasi;

class transportasiSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($c = 0; $c < 12; $c++){
            Transportasi::create([
                'nama_transportasi' => $faker->text,
                'created_by' => '',
                'updated_by' => '',
            ]);
        }

        Transportasi::find(1)->update([
            'nama_transportasi' => 'Jalan Kaki',
        ]);

        Transportasi::find(2)->update([
            'nama_transportasi' => 'Angkutan Umum/Bus/Pete-pete',
        ]);

        Transportasi::find(3)->update([
            'nama_transportasi' => 'Mobil/Bus antar jemput',
        ]);

        Transportasi::find(4)->update([
            'nama_transportasi' => 'Kereta Api',
        ]);

        Transportasi::find(5)->update([
            'nama_transportasi' => 'Ojek',
        ]);

        Transportasi::find(6)->update([
            'nama_transportasi' => 'Andong/Bendi/Sado/Dokar/Delman/Becak',
        ]);

        Transportasi::find(7)->update([
            'nama_transportasi' => 'Perahu Penyebrangan/Rakit/Getek',
        ]);

        Transportasi::find(8)->update([
            'nama_transportasi' => 'Kuda',
        ]);

        Transportasi::find(9)->update([
            'nama_transportasi' => 'Sepeda',
        ]);

        Transportasi::find(10)->update([
            'nama_transportasi' => 'Sepeda Motor',
        ]);

        Transportasi::find(11)->update([
            'nama_transportasi' => 'Mobil Pribadi',
        ]);

        Transportasi::find(12)->update([
            'nama_transportasi' => 'Lainya',
        ]);
    }
}
