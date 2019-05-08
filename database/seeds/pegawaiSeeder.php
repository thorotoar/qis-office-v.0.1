<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Faker\Provider\Image;
use App\Pegawai;
use App\User;
use App\Agama;
use App\Kewarganegaraan;
use App\Jabatan;
use App\Bank;

class pegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatanD = Jabatan::where('nama_jabatan', 'Pendidik')->first();
        $jabatanG = Jabatan::where('nama_jabatan', 'Pengasuh')->first();
        $faker = Factory::create('id_ID');
        $gender = ['Laki-laki','Perempuan'];
        $status = ['Sudah Menikah','Belum Menikah'];
        //$foto = asset('public/images/foto-pegawai/contoh.jpg');
        $instansi_g = $faker->randomElement(array('SMA 1', 'SMA 2', 'SMA 10', 'SMA 112', 'Universitas Negeri Surabaya'));

        for ($c = 0; $c < 13; $c++){
            Pegawai::create([
                'user_id' => rand(User::min('id'), User::max('id')),
                'nik' => $faker->numerify('###########'),
                'nip' => $faker->numerify('###########'),
                'foto' => $faker->imageUrl('84', '112'),
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'tempat_lahir' => $faker->city,
                'tgl_lahir' => $faker->date('d M Y','01 01 2000'),
                'kelamin' => array_random($gender),
                'agama_id' => rand(Agama::min('id'), Agama::max('id')),
                'kewarganegaraan_id' => rand(Kewarganegaraan::min('id'), Kewarganegaraan::max('id')),
                'telpon' => $faker->numerify('##########'),
                'email' => $faker->unique()->safeEmail,
                'status_pernikahan' => array_random($status),
                'nuptk' => '',
                'no_rek' => '',
                'bank_id' => rand(Bank::min('id'), Bank::max('id')),
                'kcp_bank' => '',
                'ibu' => $faker->name,
                'nik_ibu' => $faker->numerify('###########'),
                'ayah' => $faker->name,
                'nik_ayah' => $faker->numerify('###########'),
                'pasangan' => $faker->name,
                'pekerjaan_pasangan' => $faker->jobTitle,
                'tgl_masuk' => $faker->date('d M Y','01 01 2000'),
                'no_sk' => $faker->numerify('###########'),
                'created_by' => '',
                'updated_by' => '',
                'lembaga_id' => rand(\App\Lembaga::min('id'), \App\Lembaga::max('id')),
                'status_user' => '',
                'jenjang_id' => rand(\App\Jenjang::min('id'), \App\Jenjang::max('id')),
                'jurusan_id' => rand(\App\JurusanPendidikan::min('id'), \App\JurusanPendidikan::max('id')),
                'instansi' => $instansi_g,
                'thn_lulus' => $faker->year,
            ]);
        }

        Pegawai::find(1)->update([
            'nama' => 'Ir. Akhmad Mujib',
            'jabatan_yayasan_id' => '1',
            'lembaga_id' => '1',
        ]);

        Pegawai::find(2)->update([
            'nama' => 'Lili Musyafa’ah, S.Pd, M. Pd',
            'jabatan_yayasan_id' => '2',
            'lembaga_id' => '1',
        ]);

        Pegawai::find(3)->update([
            'nama' => 'Ahmad Mustafid',
            'jabatan_yayasan_id' => '3',
            'lembaga_id' => '1',
        ]);

        Pegawai::find(4)->update([
            'nama' => 'Farah Nur Jihan',
            'jabatan_yayasan_id' => '4',
            'lembaga_id' => '1',
        ]);

        Pegawai::find(5)->update([
            'nama' => 'Abraham Samad',
            'jabatan_yayasan_id' => '5',
            'lembaga_id' => '1',
        ]);

        Pegawai::find(6)->update([
            'nama' => 'Firdia Qatrunnada',
            'jabatan_yayasan_id' => '6',
            'lembaga_id' => '1',
        ]);

        Pegawai::find(7)->update([
            'nama' => 'Nizal Firmansyah',
            'jabatan_yayasan_id' => '7',
            'lembaga_id' => '1',
        ]);

        Pegawai::find(8)->update([
            'nama' => 'Muhammad Marsad Mubarok',
            'jabatan_id' => '8',
            'lembaga_id' => '2',
        ]);

        Pegawai::find(9)->update([
            'nama' => 'Lili Musyafa’ah, S.Pd, M. Pd',
            'jabatan_id' => '9',
            'lembaga_id' => '2',
        ]);

        Pegawai::find(10)->update([
            'nama' => 'Khoerun Nikmah',
            'jabatan_id' => '8',
            'lembaga_id' => '3',
        ]);

        Pegawai::find(11)->update([
            'jabatan_id' => '9',
            'lembaga_id' => '3',
        ]);

        Pegawai::find(12)->update([
            'nama' => 'Firdia Qotrunnada',
            'jabatan_id' => '8',
            'lembaga_id' => '4',
        ]);

        Pegawai::find(13)->update([
            'jabatan_id' => '9',
            'lembaga_id' => '4',
        ]);

        Pegawai::create([
            'user_id' => rand(User::min('id'), User::max('id')),
            'nik' => $faker->numerify('###########'),
            'nip' => '0000000000003',
            'foto' => $faker->imageUrl('84', '112'),
            'nama' => 'Pendidik',
            'alamat' => $faker->address,
            'tempat_lahir' => $faker->city,
            'tgl_lahir' => $faker->date('d M Y','01 01 2000'),
            'kelamin' => array_random($gender),
            'agama_id' => rand(Agama::min('id'), Agama::max('id')),
            'kewarganegaraan_id' => rand(Kewarganegaraan::min('id'), Kewarganegaraan::max('id')),
            'telpon' => $faker->numerify('##########'),
            'email' => $faker->unique()->safeEmail,
            'status_pernikahan' => array_random($status),
            'nuptk' => '',
            'no_rek' => '',
            'bank_id' => rand(Bank::min('id'), Bank::max('id')),
            'kcp_bank' => '',
            'ibu' => $faker->name,
            'nik_ibu' => $faker->numerify('###########'),
            'ayah' => $faker->name,
            'nik_ayah' => $faker->numerify('###########'),
            'pasangan' => $faker->name,
            'pekerjaan_pasangan' => $faker->jobTitle,
            'tgl_masuk' => $faker->date('d M Y','01 01 2000'),
            'no_sk' => $faker->numerify('###########'),
            'created_by' => '',
            'updated_by' => '',
            'lembaga_id' => 3,
            'status_user' => '',
            'jabatan_id' => $jabatanD->id,
            'jenjang_id' => rand(\App\Jenjang::min('id'), \App\Jenjang::max('id')),
            'jurusan_id' => rand(\App\JurusanPendidikan::min('id'), \App\JurusanPendidikan::max('id')),
            'instansi' => $instansi_g,
            'thn_lulus' => $faker->year,
        ]);

        Pegawai::create([
            'user_id' => rand(User::min('id'), User::max('id')),
            'nik' => $faker->numerify('###########'),
            'nip' => '0000000000002',
            'foto' => $faker->imageUrl('84', '112'),
            'nama' => 'Pengasuh',
            'alamat' => $faker->address,
            'tempat_lahir' => $faker->city,
            'tgl_lahir' => $faker->date('d M Y','01 01 2000'),
            'kelamin' => array_random($gender),
            'agama_id' => rand(Agama::min('id'), Agama::max('id')),
            'kewarganegaraan_id' => rand(Kewarganegaraan::min('id'), Kewarganegaraan::max('id')),
            'telpon' => $faker->numerify('##########'),
            'email' => $faker->unique()->safeEmail,
            'status_pernikahan' => array_random($status),
            'nuptk' => '',
            'no_rek' => '',
            'bank_id' => rand(Bank::min('id'), Bank::max('id')),
            'kcp_bank' => '',
            'ibu' => $faker->name,
            'nik_ibu' => $faker->numerify('###########'),
            'ayah' => $faker->name,
            'nik_ayah' => $faker->numerify('###########'),
            'pasangan' => $faker->name,
            'pekerjaan_pasangan' => $faker->jobTitle,
            'tgl_masuk' => $faker->date('d M Y','01 01 2000'),
            'no_sk' => $faker->numerify('###########'),
            'created_by' => '',
            'updated_by' => '',
            'lembaga_id' => 3,
            'status_user' => '',
            'jabatan_id' => $jabatanG->id,
            'jenjang_id' => rand(\App\Jenjang::min('id'), \App\Jenjang::max('id')),
            'jurusan_id' => rand(\App\JurusanPendidikan::min('id'), \App\JurusanPendidikan::max('id')),
            'instansi' => $instansi_g,
            'thn_lulus' => $faker->year,
        ]);
    }
}
