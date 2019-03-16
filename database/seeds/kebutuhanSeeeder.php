<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\KebutuhanKhusus;

class kebutuhanSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($c = 0; $c < 16; $c++){
            KebutuhanKhusus::create([
                'kode_kebutuhan' => $faker->word,
                'nama_kebutuhan' => $faker->sentence,
                'created_by' => '' ,
                'updated_by' => '' ,
            ]);
        }

        KebutuhanKhusus::find(1)->update([
            'kode_kebutuhan' => 'A',
            'nama_kebutuhan' => 'Tuna Netra',
        ]);

        KebutuhanKhusus::find(2)->update([
            'kode_kebutuhan' => 'B',
            'nama_kebutuhan' => 'Tuna Rungu',
        ]);

        KebutuhanKhusus::find(3)->update([
            'kode_kebutuhan' => 'C',
            'nama_kebutuhan' => 'Tuna Grahita Ringan',
        ]);

        KebutuhanKhusus::find(4)->update([
            'kode_kebutuhan' => 'C1',
            'nama_kebutuhan' => 'Tuna Grahita Sedang',
        ]);

        KebutuhanKhusus::find(5)->update([
            'kode_kebutuhan' => 'D',
            'nama_kebutuhan' => 'Tuna Daksa Ringan',
        ]);

        KebutuhanKhusus::find(6)->update([
            'kode_kebutuhan' => 'D1',
            'nama_kebutuhan' => 'Tuna Daksa Sedang',
        ]);

        KebutuhanKhusus::find(7)->update([
            'kode_kebutuhan' => 'E',
            'nama_kebutuhan' => 'Tuna Laras',
        ]);

        KebutuhanKhusus::find(8)->update([
            'kode_kebutuhan' => 'F',
            'nama_kebutuhan' => 'Tuna Wicara',
        ]);

        KebutuhanKhusus::find(9)->update([
            'kode_kebutuhan' => 'H',
            'nama_kebutuhan' => 'Hiperaktif',
        ]);

        KebutuhanKhusus::find(10)->update([
            'kode_kebutuhan' => 'I',
            'nama_kebutuhan' => 'Cerdas Istimewa',
        ]);

        KebutuhanKhusus::find(11)->update([
            'kode_kebutuhan' => 'J',
            'nama_kebutuhan' => 'Bakat Istimewa',
        ]);

        KebutuhanKhusus::find(12)->update([
            'kode_kebutuhan' => 'K',
            'nama_kebutuhan' => 'Kesulita Belajar',
        ]);

        KebutuhanKhusus::find(13)->update([
            'kode_kebutuhan' => 'N',
            'nama_kebutuhan' => 'Narkoba',
        ]);

        KebutuhanKhusus::find(14)->update([
            'kode_kebutuhan' => 'O',
            'nama_kebutuhan' => 'Indigo',
        ]);

        KebutuhanKhusus::find(15)->update([
            'kode_kebutuhan' => 'P',
            'nama_kebutuhan' => 'Down Syndrome',
        ]);

        KebutuhanKhusus::find(16)->update([
            'kode_kebutuhan' => 'Q',
            'nama_kebutuhan' => 'Autis',
        ]);
    }
}
