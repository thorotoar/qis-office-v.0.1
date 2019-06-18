<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\JenisSurat;

class jenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($c = 0; $c < 11; $c++){
            JenisSurat::create([
                'nama_jenis_surat' => $faker->sentence('5', 'true'),
                'template_surat' => '',
                'lembaga_id' => rand(\App\Lembaga::min('id'), \App\Lembaga::max('id')),
                'template_konten' => '',
                'created_by' => '',
                'updated_by' => '',
            ]);
        }

        JenisSurat::find(1)->update([
            'nama_jenis_surat' => 'Surat Pemberitahuan',
            'template_surat' => 'Template 1',
            'lembaga_id' => '1',
            'template_konten' => '<p style="text-align: justify;">Yth. <br />Bapak / Ibu/ Wali Murid <br /><strong>Dzakira Salma Latifa</strong> <br />Dengan hormat,</p>
<p style="text-align: justify;">&nbsp;</p>
<p style="text-align: justify;">Sehubungan dengan beredarnya surat ini, kami dari Quali International Surabaya memberitahukan bahwa Ananda <strong>Dzakira Salma Latifa</strong> telah melalui program pendidikan Bahasa Inggris di tempat kami Kampung Inggris Surabaya dengan mengambil 1 kali program.</p>
<p style="text-align: justify;">Program kami yakni <strong>Flash Fun For Kids</strong> yang berlangsung selama 2 bulan 24 kali pertemuan. Di dalam pembelajaran telah diselenggarakan evalusi berupa <strong>Maju Di Setiap Pembelajaran</strong>. Berdasarkan hasil evaluasi Ananda cukup mampu dalam penggunaan grammar, conversation, comprehension.</p>
<p style="text-align: justify;">Demikian surat ini kami sampaikan. Atas perhatian bapak / Ibu/ Saudara wali murid peserta didik Kampung Inggris Surabaya. Kami ucapkan terimakasih banyak.</p>
<p style="text-align: justify;">&nbsp;</p>
<p style="text-align: justify;">&nbsp;</p>
<table style="margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td style="text-align: center; vertical-align: middle;">&nbsp;</td>
<td style="text-align: center; vertical-align: middle;">Mengetahui,</td>
<td style="text-align: center; vertical-align: middle;">&nbsp;</td>
</tr>
<tr>
<td style="text-align: center; vertical-align: middle;">
<p>Bagian Pengajaran</p>
</td>
<td style="text-align: center; vertical-align: middle;">&nbsp;</td>
<td style="text-align: center; vertical-align: middle;">Instruktur Kelas</td>
</tr>
<tr>
<td style="text-align: center; vertical-align: middle;">
<p>&nbsp;</p>
<p><span style="text-decoration: underline;"><strong> Farah Nur Jihan</strong></span></p>
</td>
<td style="text-align: center; vertical-align: middle;">&nbsp;</td>
<td style="text-align: center; vertical-align: middle;">
<p>&nbsp;</p>
<p><span style="text-decoration: underline;"><strong>Khoerun Nikmah</strong> </span></p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>',
        ]);

        JenisSurat::find(2)->update([
            'nama_jenis_surat' => 'Surat Penagihan',
            'template_surat' => 'Template 1',
            'lembaga_id' => '1',
            'template_konten' => '<table style="border-collapse: collapse; float: left; height: 59px;" border="0" width="1139" cellpadding="3,3">
<tbody>
<tr>
<td style="vertical-align: middle; width: 70px;"><strong>Kepada</strong></td>
<td style="vertical-align: middle; width: 6px; text-align: left;"><strong>:</strong></td>
<td style="vertical-align: middle; width: 8185px; text-align: left;"><strong>Yth. Bagian Keuangan</strong></td>
</tr>
<tr>
<td style="vertical-align: middle; width: 70px;">&nbsp;</td>
<td style="vertical-align: middle; width: 6px; text-align: left;">&nbsp;</td>
<td style="vertical-align: middle; width: 8185; text-align: left;">Jl. Raya Palalngan Plosowayu Km 3<br />Di. Lamongan</td>
</tr>
</tbody>
</table>
<p style="text-align: justify;">&nbsp;</p>
<p style="text-align: justify;">&nbsp;<br /> <strong>Dengan Hormat</strong></p>
<p style="text-align: justify;">Bersama surat ini, kami memberitahukan bahwa berdasarkan surat Perjanjian Kerjasama No 03/QI - SBY/IX/2014 antara Quali International Surabaya dan Stikes Muhammadiyah Lamongan, kami mengingatkan kepada STIKES Muhammadiyah Lamongan untuk menyelesaikan kekurangan biaya program pembelajaran Bahasa Inggris Komunitas.</p>
<p style="text-align: justify;">Adapun biaya yang harus diselesaikan adalah biaya program sebesar @ Rp 500.000,00 dengan peserta sebanyak 82 peserta, maka :</p>
<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" border="1" cellpadding="3,3">
<tbody>
<tr>
<td style="vertical-align: middle; width: 160.694px; text-align: left;"><strong>Biyaya Program</strong></td>
<td style="vertical-align: middle; width: 160.694px; text-align: left;"><strong>Peserta</strong></td>
<td style="vertical-align: middle; width: 160.694px; text-align: left;"><strong>Julmah</strong></td>
</tr>
<tr>
<td style="width: 160.694px;">Rp 500.000,-</td>
<td style="width: 160.694px; vertical-align: middle; text-align: left;">22 orang Dosen<br />60 orang mahasiswa</td>
<td style="text-align: left; vertical-align: middle; width: 160.694px;">Rp. 41.000.000,.-</td>
</tr>
</tbody>
</table>
<p style="text-align: justify;"><strong>Terbilang : Empat puluh satu Juta rupiah.</strong></p>
<p style="text-align: justify;">Pembayaran mohon dilakukan selambat-lambatnya pada hari Senin tanggal 29 September 2014 melalui transfer antar bank ke nomor rekening BRI : 0096-01-06579150-4 an. <br />Lili Musyafa&rsquo;ah Demikian surat ini kami buat, bila ada pertanyaan ataupun hal lain yang ingin didiskusikan lebih lanjut untuk kejelasan maksud dalam surat penagihan ini mohon dapat menghubungi ibu Lili di 081228175957 atau di 081575236609 atas perhatiannya kami ucapkan banyak terima kasih.</p>
<p style="text-align: justify;">&nbsp;</p>
<table style="height: 180px; float: left;" width="310">
<tbody>
<tr style="text-align: left;">
<td style="vertical-align: middle; text-align: left; width: 303.819px;"><strong>Hormat Kami</strong></td>
</tr>
<tr>
<td style="text-align: center; vertical-align: middle; width: 303.819px;">
<p style="text-align: left;">&nbsp;</p>
<p style="text-align: left;"><span style="text-decoration: underline;"><strong>Lili Musyafa&rsquo;ah, S.Pd<br /></strong></span>Manajer Cabang Quali International-Surabaya<span style="text-decoration: underline;"><strong><br /></strong></span></p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>',
        ]);

        JenisSurat::find(3)->update([
            'nama_jenis_surat' => 'Surat Peringatan',
            'template_surat' => 'Template 1',
            'lembaga_id' => '1',
            'template_konten' => '<p style="text-align: justify;">Kepada Yth, <br />Bapak/ibu orang tua murid dari : <strong>Muhammad Marsad Mubarok</strong> <br />Di tempat,</p>
<p style="text-align: justify;"><em>Bissmillahirrahmanirrahim.</em> <br /><em>Asssalamu&rsquo;alaikum warrahmatullahi wabrakatuh.</em></p>
<p style="text-align: justify;">&nbsp; &nbsp; &nbsp;Segala puji bagi Allah Rabb semesta alam, yang memberikan rahmat serta hidayahnya sehingga sampai saat ini kita masih diberikan umur yang cukup beserta nikmat yang lainnya. Sholawat serta salam semoga tetap tercurahkan kepada junjungan kita, <em>Nabiyullah Muhammad shallallahu &lsquo;alaihi wassalam</em>, beserta keluarga, sahabat, dan seluruh umat sampai akhir zaman.</p>
<p style="text-align: justify;">&nbsp; &nbsp; &nbsp;Dengan datangnya surat ini kepada orang tua murid, dari kami pihak manajemen Lembaga Pendidikan Bahasa Inggris Quali International Surabaya (QIS) berdasarkan hasil rapat pada hari, tanggal <strong>Senin, 23 Oktober 2017</strong> memutuskan bahwa :</p>
<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;">
<tbody>
<tr style="height: 13px;">
<td style="height: 13px; width: 120px; text-align: left;">Nama Lengkap&nbsp;</td>
<td style="height: 13px; width: 5px; text-align: left;">:&nbsp;</td>
<td style="height: 13px; text-align: left;">Muhammad Marsad Mubarok</td>
</tr>
<tr style="height: 17px;">
<td style="height: 17px; width: 120px; text-align: left;">Asal</td>
<td style="height: 17px; width: 5px; text-align: left;">:</td>
<td style="height: 17px; text-align: left;">Bandung, Jawa Barat</td>
</tr>
</tbody>
</table>
<p style="text-align: justify;">&nbsp; &nbsp; &nbsp;Diberikan kesempatan untuk kembali mengikuti Pendidikan instruktur di Lembaga Pendidikan Bahasa Inggris Quali International Surabaya (QIS), dengan persyaratan yang harus dipenuhi sebagai berikut :</p>
<ol>
<li style="text-align: justify;">Tidak diperkenankan untuk membawa &amp; menggunakan alat komunikasi (hp/gadget) selama masa pendidikan berlangsung.</li>
<li style="text-align: justify;">Tidak diperkenankan untuk membawa atau mengakses ATM selama masa pendidikan berlangsung.</li>
<li style="text-align: justify;">Diharuskan meminta izin terlebih dahulu sebelum menggunakan sarana &amp; prasarana lembaga.</li>
<li style="text-align: justify;">Sanggup mentaati segala peraturan yang berlaku di Lembaga Pendidikan Bahasa Inggris Quali International Surabaya (QIS).</li>
<li style="text-align: justify;">Diharapkan bisa kembali ke tempat Pendidikan selambat lambatnya pada hari ahad, tanggal 29 Oktober, pukul : 18.00 WIB. Dengan tidak diantarkan oleh orang tua murid.</li>
</ol>
<p>&nbsp; &nbsp; &nbsp;Sehubungan dengan pentingnya surat ini, kami harap bisa dilakukan dengan sebaik sebaiknya. Demikian surat ini kami sampaikan, kurang lebihnya kami mohon maaf. Kami ucapkan terimakasih.</p>
<p><em>Wasssalamua&rsquo;alaikum warrahmatullahi wabarakatuh.</em></p>
<p>&nbsp;</p>
<table style="border-collapse: collapse; float: right;">
<tbody>
<tr>
<td style="width: 40%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
<td style="width: 40%; text-align: center;">Manager Operational<br />Quali International Surabaya (QIS)</td>
</tr>
<tr>
<td style="width: 40%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
<td style="width: 40%; text-align: center;">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><strong>Ahmad Mustafid</strong></p>
</td>
</tr>
</tbody>
</table>',
        ]);

        JenisSurat::find(4)->update([
            'kode_surat' => 'PNG',
            'nama_jenis_surat' => 'Surat Pengajuan Dana',
            'template_surat' => 'Template 1',
            'lembaga_id' => '1',
            'template_konten' => '<p style="text-align: justify;">BISSMILLAHIRRAHMANIRRAHIM..<br />&nbsp; &nbsp; &nbsp;Puji Syukur kehadrat Allah yang Maha Pengasih dan Maha Penyayang, Dengan datangnya surat ini maka kami dari bagian <strong>Administrasi</strong> ingin mengajukan Dana sebesar <strong>Rp. 200.000,.-</strong> dengan rincian sebagai berikut :</p>
<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;" border="1" cellpadding="3,3">
<tbody>
<tr>
<td style="text-align: center; vertical-align: middle; width: 32px;"><strong>No</strong></td>
<td style="text-align: center; vertical-align: middle;"><strong>Nama Barang</strong></td>
<td style="text-align: center; vertical-align: middle; width: 65px;"><strong>Frek</strong></td>
<td style="text-align: center; vertical-align: middle; width: 160px;"><strong>Harga</strong></td>
</tr>
<tr>
<td style="width: 32px; text-align: left;">1</td>
<td style="text-align: left;">Tinta Kuning EPSON Y664</td>
<td style="width: 65px; text-align: center; vertical-align: middle;">1 buah</td>
<td style="text-align: left; vertical-align: middle; width: 160px;">Rp. 85.000,.-</td>
</tr>
<tr>
<td style="width: 32px; text-align: left;">2</td>
<td style="text-align: left;">Tinta Hitam EPSON BK664&nbsp;</td>
<td style="width: 65px; text-align: center; vertical-align: middle;">1 buah</td>
<td style="text-align: left; vertical-align: middle; width: 160px;">Rp. 85.000,.-</td>
</tr>
<tr>
<td style="width: 32px; text-align: left;">3</td>
<td style="text-align: left;">Lakban Kuning&nbsp;</td>
<td style="width: 65px; text-align: center; vertical-align: middle;">1 buah</td>
<td style="text-align: left; vertical-align: middle; width: 160px;">Rp. 10.000,.-</td>
</tr>
<tr>
<td style="width: 32px; text-align: left;">4</td>
<td style="text-align: left;">Transport</td>
<td style="width: 65px; text-align: center; vertical-align: middle;">&nbsp;</td>
<td style="text-align: left; vertical-align: middle; width: 160px;">Rp. 10.000,.-</td>
</tr>
<tr>
<td style="text-align: center; vertical-align: middle;" colspan="2">&nbsp;<strong>Jumlah Total</strong></td>
<td style="width: 65px;">&nbsp;</td>
<td style="text-align: left; vertical-align: middle; width: 160px;">Rp. 190.000,.-</td>
</tr>
</tbody>
</table>
<p style="text-align: justify;">&nbsp; &nbsp; &nbsp;Demikian Surat ini kami sampaikan. Semoga dari pihak yang berkenan mensetujui apa yang telah kami ajukan, atas kerjasamanya kami sampaikan terimakasih.</p>
<p style="text-align: justify;">&nbsp;</p>
<p style="text-align: justify;">&nbsp;</p>
<table style="margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td style="text-align: center; vertical-align: middle;">&nbsp;</td>
<td style="text-align: center; vertical-align: middle;">Mengetahui,</td>
<td style="text-align: center; vertical-align: middle;">&nbsp;</td>
</tr>
<tr>
<td style="text-align: center; vertical-align: middle;">
<p>Bagian Administrasi</p>
</td>
<td style="text-align: center; vertical-align: middle;">&nbsp;</td>
<td style="text-align: center; vertical-align: middle;">Bagian Bendahara</td>
</tr>
<tr>
<td style="text-align: center; vertical-align: middle;">
<p>&nbsp;</p>
<p><strong>Nizal Frimansyah</strong></p>
</td>
<td style="text-align: center; vertical-align: middle;">&nbsp;</td>
<td style="text-align: center; vertical-align: middle;">
<p>&nbsp;</p>
<p><strong>Firda Qurroaini</strong></p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>',
        ]);

        JenisSurat::find(5)->update([
            'kode_surat' => 'SK',
            'nama_jenis_surat' => 'Surat Pengangkatan',
            'template_surat' => 'Template 2',
            'lembaga_id' => '1',
            'template_konten' => '<p style="text-align: justify;">Berdasarkan rapat yang dilaksanakan pada hari Rabu, tanggal 02 Januari 2013, saya yang bertanda tangan di bawah ini</p>
<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td style="width: 80px; text-align: left;">Nama&nbsp;</td>
<td style="width: 5px; text-align: left;">:&nbsp;</td>
<td style="text-align: left;">Akhmad Mujib, ST</td>
</tr>
<tr>
<td style="width: 80px; text-align: left;">Jabatan&nbsp;</td>
<td style="width: 5px; text-align: left;">:</td>
<td style="text-align: left;">Direktur Quali International Surabaya</td>
</tr>
</tbody>
</table>
<p style="text-align: justify;"><strong>Menimbang</strong>, bahwa nama tersebut di bawah ini :</p>
<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td style="width: 170px; text-align: left;">Nama</td>
<td style="width: 5px; text-align: left;">:</td>
<td style="text-align: left;">Lili Musyafa&rsquo;ah, S.Pd</td>
</tr>
<tr>
<td style="width: 170px; text-align: left;">Tempat Tanggal Lahir&nbsp;</td>
<td style="width: 5px; text-align: left;">:&nbsp;</td>
<td style="text-align: left;">Jakarta, 12 Maret 1970</td>
</tr>
<tr>
<td style="width: 170px; text-align: left;">Pendidikan Terakhir</td>
<td style="width: 5px; text-align: left;">:</td>
<td style="text-align: left;">S-1 Bahasa Inggris, IKIP Semarang</td>
</tr>
</tbody>
</table>
<p style="text-align: justify;"><strong>Memutuskan</strong>, nama tersebut di atas diangkat sebagai <strong>Manager</strong> di Quali International cabang Surabaya.</p>
<p style="text-align: justify;">Demikian surat keputusan tersebut dibuat, dan dapat digunakan sebagaimana mestinya.</p>
<p style="text-align: justify;">&nbsp;</p>
<table style="float: right;">
<tbody>
<tr>
<td style="width: 40%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
<td style="width: 40%; text-align: center;">Surabaya, 2 Januari 2014</td>
</tr>
<tr>
<td style="width: 40%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
<td style="width: 40%; text-align: center;">Mengetahui,</td>
</tr>
<tr>
<td style="width: 40%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
<td style="width: 40%; text-align: center;">
<p>&nbsp;</p>
<p><strong><span style="text-decoration: underline;">Akhmad Mujib, ST</span><br /></strong>Direktur Quali International Surabaya</p>
</td>
</tr>
</tbody>
</table>',
        ]);

        JenisSurat::find(6)->update([
            'nama_jenis_surat' => 'Surat Keterangan Pengalaman',
            'template_surat' => 'Template 2',
            'lembaga_id' => '1',
            'template_konten' => '<p style="text-align: justify;">Yang bertandatangan di bawah ini :</p>
<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td style="width: 80px; text-align: left;">Nama&nbsp;</td>
<td style="width: 5px; text-align: left;">:&nbsp;</td>
<td style="text-align: left;">Lili Musyafa&rsquo;ah S. Pd</td>
</tr>
<tr>
<td style="width: 80px; text-align: left;">Jabatan&nbsp;</td>
<td style="width: 5px; text-align: left;">:</td>
<td style="text-align: left;">Pimpinan LPBI Quali International Surabaya (QIS)</td>
</tr>
</tbody>
</table>
<p style="text-align: justify;">Menerangkan bahwa :</p>
<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td style="width: 170px; text-align: left;">Nama Lengkap&nbsp;</td>
<td style="width: 5px; text-align: left;">:</td>
<td style="text-align: left;">Siti Sri Lestari</td>
</tr>
<tr>
<td style="width: 170px; text-align: left;">Jabatan&nbsp;</td>
<td style="width: 5px; text-align: left;">:&nbsp;</td>
<td style="text-align: left;">Instruktur LPBI Quali International Surabaya (QIS)</td>
</tr>
<tr>
<td style="width: 170px; text-align: left;">Periode</td>
<td style="width: 5px; text-align: left;">:</td>
<td style="text-align: left;">Sejak 01 April 2016 &ndash; 31 Mei 2018</td>
</tr>
</tbody>
</table>
<p style="text-align: justify;">Pernah bekerja di Lembaga kami <strong>LKP Quali International Surabaya (QIS)</strong> sebagai Instruktur Bahasa Inggris. Adapun sikap dan hasil kerja nama tersebut di atas dinilai baik.</p>
<p style="text-align: justify;">Demikian surat ini kami buat dengan sebenar benarnya.</p>
<p style="text-align: justify;">&nbsp;</p>
<table style="float: right;">
<tbody>
<tr>
<td style="width: 40%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
<td style="text-align: center;">Surabaya, 2 Januari 2014</td>
</tr>
<tr>
<td style="width: 40%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
<td style="width: 40%; text-align: center;">Pimpinan<br />Quali International Surabaya (QIS)</td>
</tr>
<tr>
<td style="width: 40%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
<td style="width: 40%; text-align: center;">
<p>&nbsp;</p>
<p><strong>Lili Musyafa&rsquo;ah, S. Pd, M. Pd</strong></p>
</td>
</tr>
</tbody>
</table>
<p style="text-align: justify;">&nbsp;</p>',
        ]);

        JenisSurat::find(7)->update([
            'nama_jenis_surat' => 'Surat Keputusan Penyusun Instruktur',
            'template_surat' => 'Template 2',
            'lembaga_id' => '1',
            'template_konten' => '<p style="text-align: justify;">Berdasarkan rapat yang dilaksanakan bersama Direktur Quali International pada hari Senin, tanggal 6 Oktober 2014, saya yang bertanda tangan di bawah ini</p>
<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td style="width: 60px; text-align: left; vertical-align: middle;">Nama</td>
<td style="text-align: left; vertical-align: middle; width: 5px;">:</td>
<td style="text-align: left; vertical-align: middle;">Lili Musyafa\'ah, S.Pd</td>
</tr>
<tr>
<td style="width: 60px; text-align: left; vertical-align: middle;">Jabatan&nbsp;</td>
<td style="text-align: left; vertical-align: middle; width: 5px;">:&nbsp;</td>
<td style="text-align: left; vertical-align: middle;">Manager Cabang Quali International Surabaya</td>
</tr>
</tbody>
</table>
<p><span style="text-align: justify;">Memutuskan, bahwa calon instruktur di bawah ini :</span></p>
<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td style="width: 164px; text-align: left; vertical-align: middle;">Nama</td>
<td style="text-align: left; vertical-align: middle; width: 5px;">:</td>
<td style="text-align: left; vertical-align: middle;">Ahmad Mustafid</td>
</tr>
<tr>
<td style="width: 164px; text-align: left; vertical-align: middle;">Tempat Tanggal Lahir&nbsp;</td>
<td style="text-align: left; vertical-align: middle; width: 5px;">:&nbsp;</td>
<td style="text-align: left; vertical-align: middle;">Pati, 15 Maret 1991</td>
</tr>
<tr>
<td style="width: 164px; text-align: left; vertical-align: middle;">Pendidikan Terakhir</td>
<td style="text-align: left; vertical-align: middle; width: 5px;">:</td>
<td style="text-align: left; vertical-align: middle;">MA (PP AL FITROH) lulusan tahun 2011</td>
</tr>
</tbody>
</table>
<p><span style="text-align: justify;">Telah selesai menjalankan PROGRAM mengajar dengan klasifikasi level INSTRUKTUR MUDA Bahasa Inggris pada kurun waktu 04 Pebruari 2013 sampai dengan 31 Juli 2014,</span></p>
<p><strong>Memutuskan :</strong><br />Nama tersebut di atas di angkat sebagai INSTRUKTUR MADYA Bahasa Inggris di Quali International Surabaya dengan kurun waktu 1 (tahun) terhitung per tanggal 6 Oktober 2014 sampai dengan 5 Oktober 2015.</p>
<p style="text-align: justify;">Diwajibkan atas saudara Mustafid mengajar minimal 48 jam per minggu. Yang bersangkutan berhak menerima gaji sebesar Rp. 700.000,00 per bulan dan bonus mengajar sebesar Rp. 300.000,00 per bulan yang akan diberikan setiap tanggal 05 pada bulan berikutnya. Serta berhak mendapat makan 3x per hari, tempat tinggal dan transportasi mengajar.</p>
<p style="text-align: justify;">Demikian surat keputusan tersebut dibuat, dan dapat digunakan sebagaimana mestinya.</p>
<p style="text-align: justify;">&nbsp;</p>
<p style="text-align: justify;">&nbsp;</p>
<table style="float: right;">
<tbody>
<tr>
<td style="width: 40%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
<td style="width: 40%; text-align: center;">Surabaya, 2 Januari 2014</td>
</tr>
<tr>
<td style="width: 40%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
<td style="width: 40%; text-align: center;">Mengetahui,</td>
</tr>
<tr>
<td style="width: 40%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
<td style="width: 40%; text-align: center;">
<p>&nbsp;</p>
<p><span style="text-decoration: underline;"><strong>Lili Musyafa&rsquo;ah, S.Pd</strong></span><br />Manager Cabang Surabaya</p>
</td>
</tr>
</tbody>
</table>
<p style="text-align: justify;">&nbsp;</p>
<p>&nbsp;</p>',
        ]);

        JenisSurat::find(8)->update([
            'nama_jenis_surat' => 'Surat Keputusan Penyusun Sylabus',
            'template_surat' => 'Template 2',
            'lembaga_id' => '1',
            'template_konten' => '<p style="text-align: justify;">Berdasarkan rapat yang dilaksanakan bersama Direktur Quali International Surabaya (QIS) pada hari Jum&rsquo;at, tanggal 2 Januari 2015,&nbsp;saya yang bertanda tangan di bawah ini</p>
<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td style="width: 70px; text-align: left;">Nama</td>
<td style="width: 5px; text-align: left;">:</td>
<td style="text-align: left;">Akhmad Mujib, ST</td>
</tr>
<tr>
<td style="width: 70px; text-align: left;">Jabatan&nbsp;</td>
<td style="width: 5px; text-align: left;">:&nbsp;</td>
<td style="text-align: left;">Direktur Quali International Surabaya</td>
</tr>
</tbody>
</table>
<p><span style="text-align: justify;">Memutuskan, bahwa nama tersebut di bawah ini :</span></p>
<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td style="width: 170px; text-align: left;">Nama</td>
<td style="width: 5px; text-align: left;">:&nbsp;</td>
<td style="text-align: left;">Lili Musyafa&rsquo;ah, S.Pd</td>
</tr>
<tr>
<td style="width: 170px; text-align: left;">Tempat Tanggal Lahir&nbsp;</td>
<td style="width: 5px; text-align: left;">:</td>
<td style="text-align: left;">Jakarta, 12 Maret 1970</td>
</tr>
<tr>
<td style="width: 170px; text-align: left;">Pendidikan Terakhir</td>
<td style="width: 5px; text-align: left;">:</td>
<td style="text-align: left;">S-1 Bahasa Inggris, IKIP Semarang</td>
</tr>
</tbody>
</table>
<p><strong style="text-align: justify;">Memutuskan :<br /></strong>Nama tersebut di atas di angkat sebagai Penyusun Silabus Pengajaran Bahasa Inggris level Survival , Comunication dan Advance di Quali International Surabaya(QIS) dengan kurun waktu 1 (tahun) terhitung per tanggal 02 Januari 2015 sampai dengan 31 Desember 2015.</p>
<p style="text-align: justify;">Demikian surat keputusan tersebut dibuat, dan dapat digunakan sebagaimana mestinya.</p>
<p style="text-align: justify;">&nbsp;</p>
<table style="float: right;">
<tbody>
<tr>
<td style="width: 40%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
<td style="width: 40%; text-align: center;">Surabaya, 2 Januari 2014</td>
</tr>
<tr>
<td style="width: 40%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
<td style="width: 40%; text-align: center;">Mengetahui,</td>
</tr>
<tr>
<td style="width: 40%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
<td style="width: 40%; text-align: center;">
<p>&nbsp;</p>
<p><strong><span style="text-decoration: underline;"><br />Akhmad Mujib, ST</span><br /></strong>Direktur Quali International Surabaya</p>
</td>
</tr>
</tbody>
</table>
<p style="text-align: justify;">&nbsp;</p>',
        ]);

        JenisSurat::find(9)->update([
            'nama_jenis_surat' => 'Surat Keputusan Penyusun RPP',
            'template_surat' => 'Template 2',
            'lembaga_id' => '1',
            'template_konten' => '<p style="text-align: justify;">Berdasarkan rapat yang dilaksanakan bersama Direktur Quali International pada hari Senin, tanggal 2 Januari 2014, saya yang bertanda tangan di bawah ini</p>
<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td style="width: 80px; text-align: left;">Nama&nbsp;</td>
<td style="width: 5px; text-align: left;">:&nbsp;</td>
<td style="text-align: left;">Akhmad Mujib, ST</td>
</tr>
<tr>
<td style="width: 80px; text-align: left;">Jabatan&nbsp;</td>
<td style="width: 5px; text-align: left;">:</td>
<td style="text-align: left;">Direktur Quali International Surabaya</td>
</tr>
</tbody>
</table>
<p style="text-align: justify;">Memutuskan, bahwa nama tersebut di bawah ini :</p>
<table style="border-collapse: collapse; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td style="width: 170px; text-align: left;">Nama</td>
<td style="width: 5px; text-align: left;">:</td>
<td style="text-align: left;">Lili Musyafa&rsquo;ah, S.Pd</td>
</tr>
<tr>
<td style="width: 170px; text-align: left;">Tempat Tanggal Lahir&nbsp;</td>
<td style="width: 5px; text-align: left;">:&nbsp;</td>
<td style="text-align: left;">Jakarta, 12 Maret 1970</td>
</tr>
<tr>
<td style="width: 170px; text-align: left;">Pendidikan Terakhir</td>
<td style="width: 5px; text-align: left;">:</td>
<td style="text-align: left;">S-1 Bahasa Inggris, IKIP Semarang</td>
</tr>
</tbody>
</table>
<p style="text-align: justify;"><strong>Memutuskan :</strong><br />Nama tersebut di atas di angkat sebagai Penyusun Silabus Pengajaran Bahasa Inggris level elementary , intermediate dan advance di Quali International Surabaya dengan kurun waktu 1 (tahun) terhitung per tanggal 02 Januari 2014 sampai dengan 31 Desember 2014.</p>
<p style="text-align: justify;">Demikian surat keputusan tersebut dibuat, dan dapat digunakan sebagaimana mestinya.</p>
<p style="text-align: justify;">&nbsp;</p>
<table style="float: right;">
<tbody>
<tr>
<td style="width: 40%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
<td style="width: 40%; text-align: center;">Surabaya, 2 Januari 2014</td>
</tr>
<tr>
<td style="width: 40%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
<td style="width: 40%; text-align: center;">Mengetahui,</td>
</tr>
<tr>
<td style="width: 40%;">&nbsp;</td>
<td style="width: 30%;">&nbsp;</td>
<td style="width: 40%; text-align: center;">
<p>&nbsp;</p>
<p><strong><span style="text-decoration: underline;"><br />Akhmad Mujib, ST</span><br /></strong>Direktur Quali International Surabaya</p>
</td>
</tr>
</tbody>
</table>
<p style="text-align: justify;">&nbsp;</p>',
        ]);

        JenisSurat::find(10)->update([
            'nama_jenis_surat' => 'Test Template MDC',
            'template_surat' => 'Template 1',
            'lembaga_id' => '3',
        ]);

        JenisSurat::find(11)->update([
            'nama_jenis_surat' => 'Test Template MDC',
            'template_surat' => 'Template 2',
            'lembaga_id' => '4',
        ]);
    }
}
