<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Bank;

class bankSeeder extends Seeder
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
            $bank = Bank::create([
                'nama_bank' => $faker->sentence('1', 'true'),
                'created_by' => '',
                'updated_by' => '',
            ]);
        }

        Bank::find(1)->update([
            'nama_bank' => 'BRI',
        ]);

        Bank::find(2)->update([
            'nama_bank' => 'BNI',
        ]);

        Bank::find(3)->update([
            'nama_bank' => 'BCA',
        ]);

        Bank::find(4)->update([
            'nama_bank' => 'BI',
        ]);

        Bank::find(5)->update([
            'nama_bank' => 'BANK JATIM',
        ]);

        Bank::find(6)->update([
            'nama_bank' => 'BTN',
        ]);

        Bank::find(7)->update([
            'nama_bank' => 'MANDIRI',
        ]);
    }
}
