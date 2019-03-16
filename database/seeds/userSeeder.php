<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\User;

class userSeeder extends Seeder
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
            $user = user::create([
                'username' => $faker->userName,
                'nama_user' => $faker->name,
                //'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('secret'),
                'password_a' => 'secret',
                'email_user' => '',
                'foto_user' => '',
                'type' => $faker->sentence('1', 'true'),
                'created_by' => '',
                'updated_by' => '',
                'remember_token' => str_random(10),
            ]);
        }

        User::find(1)->update([
            'username' => 'admin',
            'type' => 'admin',
        ]);

        User::find(2)->update([
            'username' => 'pegawai',
            'type' => 'pegawai',
        ]);
    }
}
