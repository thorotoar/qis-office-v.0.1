<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);

        $this->call(userSeeder::class);
        $this->call(lembagaSeeder::class);
        $this->call(jenisSuratSeeder::class);
        $this->call(jabatanSeeder::class);
        $this->call(agamaSeeder::class);
        $this->call(jenjangSeeder::class);
        $this->call(jurusanPendidikanSeeder::class);
        $this->call(kebutuhanSeeeder::class);
        $this->call(transportasiSeeeder::class);
        $this->call(provinsiSeeder::class);
        $this->call(kabupatenSeeder::class);
        $this->call(kecamatanSeeder::class);
        $this->call(bankSeeder::class);
        $this->call(kewarganegaraanSeeder::class);
        $this->call(penghasilanSeeeder::class);
        $this->call(KategoriDokumenSeeder::class);
        $this->call(pegawaiSeeder::class);
    }
}
