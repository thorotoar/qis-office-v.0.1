<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\JabatanYayasan;

class jabayaSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($c = 0; $c < 2; $c++){
            JabatanYayasan::create([
                'nama_jabatan_yayasan' => $faker->word,
                'created_by' => '',
                'updated_by' => '',
            ]);
        }

        JabatanYayasan::find(1)->update([
            'nama_jabatan_yayasan' => 'Pemimpin',
        ]);

        JabatanYayasan::find(2)->update([
            'nama_jabatan_yayasan' => 'Instruktur',
        ]);
    }
}
