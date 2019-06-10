<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcomeq');
})->middleware('unauthorized');

Route::get('/test', function () {
    return view('test');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function (){

    Route::get('/', [
        'uses' => 'AdminController@index',
        'as' => 'home-admin'
    ]);

    Route::get('/surat-masuk', [
        'uses' => 'AdminController@viewsma',
        'as' => 'surat-masuk-admin'
    ]);

    Route::get('/surat-keluar', [
        'uses' => 'AdminController@viewska',
        'as' => 'surat-keluar-admin'
    ]);

    Route::get('/ubah-password-admin', [
        'uses' => 'AdminController@changePassAdmin',
        'as' => 'upass-admin'
    ]);

    Route::post('/update-password-admin', [
        'uses' => 'AdminController@changeAdmin',
        'as' => 'ua-pass',
    ]);

    //Route::post('/tambah/user','AdminController@tambahuser')->name('save.user');

    //part-of-user-pegawai
    Route::group(['prefix' => 'surat-keluar'], function (){

        Route::get('/', [
            'uses' => 'AdminSuratKeluarController@index',
            'as' => 'a-surk-home'
        ]);

        Route::get('/surat-keluar-edit', [
            'uses' => 'AdminSuratKeluarController@edit',
            'as' => 'a-surk-edit'
        ]);

        Route::post('/update-surat-keluar/{id}', [
            'uses' => 'AdminSuratKeluarController@update',
            'as' => 'a-surk-update'
        ]);

        Route::delete('/hapus-surat-keluar/{id}', [
            'uses' => 'AdminSuratKeluarController@destroy',
            'as' => 'a-surk-hapus'
        ]);

        Route::get('/search-kode/{Q}', [
            'uses' => 'AdminSuratKeluarController@searchJabatan',
            'as' => 'a-surk-search'
        ]);

        Route::get('/surat-keluar-print', [
            'uses' => 'AdminSuratKeluarController@print',
            'as' => 'a-surk-print'
        ]);
    });

    Route::group(['prefix' => 'surat-masuk'], function (){

        Route::get('/', [
            'uses' => 'AdminSuratMasukController@index',
            'as' => 'a-surm-home'
        ]);

        Route::get('/surat-masuk-edit', [
            'uses' => 'AdminSuratMasukController@edit',
            'as' => 'a-surm-edit'
        ]);

        Route::post('/update-surat-masuk/{id}', [
            'uses' => 'AdminSuratMasukController@update',
            'as' => 'a-surm-update'
        ]);

        Route::delete('/hapus-surat-masuk/{id}', [
            'uses' => 'AdminSuratMasukController@destroy',
            'as' => 'a-surm-hapus'
        ]);

    });

    Route::group(['prefix' => 'jadwal-pelajaran'], function (){

        Route::get('/qis', [
            'uses' => 'AdminJadwalController@indexQIS',
            'as' => 'aj.qis'
        ]);

        Route::get('/mdc', [
            'uses' => 'AdminJadwalController@indexMDC',
            'as' => 'aj.mdc'
        ]);

        Route::get('/abk', [
            'uses' => 'AdminJadwalController@indexABK',
            'as' => 'aj.abk'
        ]);

        Route::get('/jadwal-edit', [
            'uses' => 'AdminJadwalController@edit',
            'as' => 'aj-edit'
        ]);

        Route::post('/update-jadwal', [
            'uses' => 'AdminJadwalController@update',
            'as' => 'aj-update'
        ]);

        Route::delete('/hapus-jadwal-/{id}', [
            'uses' => 'AdminJadwalController@destroy',
            'as' => 'aj-hapus'
        ]);

        Route::get('/modal-jadwal-mdc/{id}', [
            'uses' => 'AdminJadwalController@modalJadwal',
            'as' => 'aj-modal-jadwal'
        ]);
    });

    Route::group(['prefix' => 'data-pegawai'], function (){

        Route::get('/', [
            'uses' => 'AdminPegawaiController@index',
            'as' => 'ad-pegawai'
        ]);

        Route::get('/jabatan', [
            'uses' => 'AdminPegawaiController@jabatan',
            'as' => 'a-json-jabatan'
        ]);

        Route::get('/edit-pegawai', [
            'uses' => 'AdminPegawaiController@edit',
            'as' => 'ad-p-edit'
        ]);

        Route::post('/update-pegawai/{id}', [
            'uses' => 'AdminPegawaiController@update',
            'as' => 'ad-u-pegawai'
        ]);

        Route::delete('/hapus/{id}', [
            'uses' => 'AdminPegawaiController@destroy',
            'as' => 'ad-h-p-pegawai'
        ]);
    });

    Route::group(['prefix' => 'peserta-didik'], function (){

        Route::get('/', [
            'uses' => 'AdminPesertaController@index',
            'as' => 'ap-home'
        ]);

        Route::get('/kabupaten', [
            'uses' => 'AdminPesertaController@kabupaten',
            'as' => 'a-json-kabupaten'
        ]);

        Route::get('/kecamatan', [
            'uses' => 'AdminPesertaController@kecamatan',
            'as' => 'a-json-kecamatan'
        ]);

        Route::get('/peserta-edit', [
            'uses' => 'AdminPesertaController@edit',
            'as' => 'ap-edit'
        ]);

        Route::post('/update-peserta/{id}', [
            'uses' => 'AdminPesertaController@update',
            'as' => 'ap-update'
        ]);

        Route::delete('/hapus-peserta/{id}', [
            'uses' => 'AdminPesertaController@destroy',
            'as' => 'ap-hapus'
        ]);

        Route::get('/nilai-peserta/{id}', [
            'uses' => 'AdminPesertaController@lihatNilai',
            'as' => 'ap-nilai'
        ]);
    });

    Route::group(['prefix' => 'dokumen'], function (){

        Route::get('/', [
            'uses' => 'AdminDokumenController@index',
            'as' => 'ad-home'
        ]);

        Route::get('/dokumen-show', [
            'uses' => 'AdminDokumenController@show',
            'as' => 'ad-show'
        ]);

        Route::get('/dokumen-download', [
            'uses' => 'AdminDokumenController@download',
            'as' => 'ad-download'
        ]);

        Route::get('/dokumen-edit', [
            'uses' => 'AdminDokumenController@edit',
            'as' => 'ad-edit'
        ]);

        Route::post('/update-dokumen/{id}', [
            'uses' => 'AdminDokumenController@update',
            'as' => 'ad-update'
        ]);

        Route::delete('/hapus-dokumen/{id}', [
            'uses' => 'AdminDokumenController@destroy',
            'as' => 'ad-hapus'
        ]);

    });
    //end-of-user-pegawai

    Route::group(['prefix' => 'manajemen-user'], function (){

        Route::get('/', [
            'uses' => 'UserManajemenController@index',
            'as' => 'um-home'
        ]);

        Route::get('/manajemen-user-tambah', [
            'uses' => 'UserManajemenController@create',
            'as' => 'um-tambah'
        ]);

        Route::get('/lihat-user/{id}', [
            'uses' => 'UserManajemenController@show',
            'as' => 'um-lihat'
        ]);

        Route::post('/tambah-user', [
            'uses' => 'UserManajemenController@store',
            'as' => 'um-tambah-selesai'
        ]);

        Route::get('/user-edit', [
            'uses' => 'UserManajemenController@edit',
            'as' => 'um-edit'
        ]);

        Route::post('/update-user/{id}', [
            'uses' => 'UserManajemenController@update',
            'as' => 'um-update'
        ]);

        Route::delete('/hapus-user/{id}', [
            'uses' => 'UserManajemenController@destroy',
            'as' => 'um-hapus'
        ]);
    });

    Route::group(['prefix' => 'manajemen-jabatan'], function (){

        Route::get('/', [
            'uses' => 'JabatanController@index',
            'as' => 'jm-home'
        ]);

        Route::get('/manajemen-jabatan-tambah', [
            'uses' => 'JabatanController@create',
            'as' => 'jm-tambah'
        ]);

        Route::get('/lihat-jabatan/{id}', [
            'uses' => 'JabatanController@show',
            'as' => 'jm-lihat'
        ]);

        Route::post('/tambah-jabatan', [
            'uses' => 'JabatanController@store',
            'as' => 'jm-tambah-selesai'
        ]);

        Route::get('/jabatan-edit', [
            'uses' => 'JabatanController@edit',
            'as' => 'jm-edit'
        ]);

        Route::post('/update-jabatan/{id}', [
            'uses' => 'JabatanController@update',
            'as' => 'jm-update'
        ]);

        Route::delete('/hapus-jabatan/{id}', [
            'uses' => 'JabatanController@destroy',
            'as' => 'jm-hapus'
        ]);

        Route::get('/jabatan-import', [
            'uses' => 'JabatanController@getJabatan',
            'as' => 'get.jabatan'
        ]);
    });

    Route::group(['prefix' => 'manajemen-jenis-surat'], function (){

        Route::get('/', [
            'uses' => 'JenisSuratController@index',
            'as' => 'jsm-home'
        ]);

        Route::get('/manajemen-jenis-surat-tambah', [
            'uses' => 'JenisSuratController@create',
            'as' => 'jsm-tambah'
        ]);

        Route::get('/lihat-jenis-surat', [
            'uses' => 'JenisSuratController@show',
            'as' => 'jsm-show'
        ]);

        Route::post('/tambah-jenis-surat', [
            'uses' => 'JenisSuratController@store',
            'as' => 'jsm-tambah-selesai'
        ]);

        Route::get('/jenis-surat-edit', [
            'uses' => 'JenisSuratController@edit',
            'as' => 'jsm-edit'
        ]);

        Route::post('/update-jenis-surat/{id}', [
            'uses' => 'JenisSuratController@update',
            'as' => 'jsm-update'
        ]);

        Route::delete('/hapus-jenis-surat/{id}', [
            'uses' => 'JenisSuratController@destroy',
            'as' => 'jsm-hapus'
        ]);
    });

    Route::group(['prefix' => 'manajemen-jenjang'], function (){

        Route::get('/', [
            'uses' => 'JenjangController@index',
            'as' => 'jen-home'
        ]);

        Route::get('/manajemen-jenjang-tambah', [
            'uses' => 'JenjangController@create',
            'as' => 'jen-tambah'
        ]);

        Route::post('/tambah-jenjang', [
            'uses' => 'JenjangController@store',
            'as' => 'jen-tambah-selesai'
        ]);

        Route::get('/jenjang-edit', [
            'uses' => 'JenjangController@edit',
            'as' => 'jen-edit'
        ]);

        Route::post('/update-jenjang/{id}', [
            'uses' => 'JenjangController@update',
            'as' => 'jen-update'
        ]);

        Route::delete('/hapus-jenjang/{id}', [
            'uses' => 'JenjangController@destroy',
            'as' => 'jen-hapus'
        ]);
    });

    Route::group(['prefix' => 'manajemen-jurusan'], function (){

        Route::get('/', [
            'uses' => 'JurusanController@index',
            'as' => 'jur-home'
        ]);

        Route::get('/manajemen-jurusan-tambah', [
            'uses' => 'JurusanController@create',
            'as' => 'jur-tambah'
        ]);

        Route::post('/tambah-jurusan', [
            'uses' => 'JurusanController@store',
            'as' => 'jur-tambah-selesai'
        ]);

        Route::get('/jurusan-edit', [
            'uses' => 'JurusanController@edit',
            'as' => 'jur-edit'
        ]);

        Route::post('/update-jurusan/{id}', [
            'uses' => 'JurusanController@update',
            'as' => 'jur-update'
        ]);

        Route::delete('/hapus-jurusan/{id}', [
            'uses' => 'JurusanController@destroy',
            'as' => 'jur-hapus'
        ]);
    });

    Route::group(['prefix' => 'manajemen-kebutuhan-khusus'], function (){

        Route::get('/', [
            'uses' => 'KebutuhanKhususController@index',
            'as' => 'keb-home'
        ]);

        Route::get('/manajemen-kebutuhan-khusus-tambah', [
            'uses' => 'KebutuhanKhususController@create',
            'as' => 'keb-tambah'
        ]);

        Route::get('/lihat-kebutuhan-khusus/{id}', [
            'uses' => 'KebutuhanKhususController@show',
            'as' => 'keb-lihat'
        ]);

        Route::post('/tambah-kebutuhan-khusus', [
            'uses' => 'KebutuhanKhususController@store',
            'as' => 'keb-tambah-selesai'
        ]);

        Route::get('/kebutuhan-khusus-edit', [
            'uses' => 'KebutuhanKhususController@edit',
            'as' => 'keb-edit'
        ]);

        Route::post('/update-kebutuhan-khusus/{id}', [
            'uses' => 'KebutuhanKhususController@update',
            'as' => 'keb-update'
        ]);

        Route::delete('/hapus-kebutuhan-khusus/{id}', [
            'uses' => 'KebutuhanKhususController@destroy',
            'as' => 'keb-hapus'
        ]);
    });

    Route::group(['prefix' => 'manajemen-lembaga'], function (){

        Route::get('/', [
            'uses' => 'LembagaController@index',
            'as' => 'lem-home'
        ]);

        Route::get('/manajemen-lembaga-tambah', [
            'uses' => 'LembagaController@create',
            'as' => 'lem-tambah'
        ]);

        Route::post('/tambah-lembaga', [
            'uses' => 'LembagaController@store',
            'as' => 'lem-tambah-selesai'
        ]);

        Route::get('/lembaga-edit', [
            'uses' => 'LembagaController@edit',
            'as' => 'lem-edit'
        ]);

        Route::post('/update-lembaga/{id}', [
            'uses' => 'LembagaController@update',
            'as' => 'lem-update'
        ]);

        Route::delete('/hapus-lembaga/{id}', [
            'uses' => 'LembagaController@destroy',
            'as' => 'lem-hapus'
        ]);
    });

    Route::group(['prefix' => 'manajemen-transportasi'], function (){

        Route::get('/', [
            'uses' => 'TransportasiController@index',
            'as' => 'tran-home'
        ]);

        Route::get('/manajemen-transportasi-tambah', [
            'uses' => 'TransportasiController@create',
            'as' => 'tran-tambah'
        ]);

        Route::get('/lihat-transportasi/{id}', [
            'uses' => 'TransportasiController@show',
            'as' => 'tran-lihat'
        ]);

        Route::post('/tambah-transportasi', [
            'uses' => 'TransportasiController@store',
            'as' => 'tran-tambah-selesai'
        ]);

        Route::get('/transportasi-edit', [
            'uses' => 'TransportasiController@edit',
            'as' => 'tran-edit'
        ]);

        Route::post('/update-transportasi/{id}', [
            'uses' => 'TransportasiController@update',
            'as' => 'tran-update'
        ]);

        Route::delete('/hapus-transportasi/{id}', [
            'uses' => 'TransportasiController@destroy',
            'as' => 'tran-hapus'
        ]);
    });

});

Route::group(['prefix' => 'pegawai', 'namespace' => 'Pegawai', 'middleware' => 'pegawai'], function (){
    Route::get('test-email', function () {
        return view('mail.m-personal');
    });

    Route::get('/', [
        'uses' => 'PegawaiController@index',
        'as' => 'home-pegawai'
    ]);

    Route::get('/ubah-password', [
        'uses' => 'PegawaiController@changePass',
        'as' => 'upass-pegawai'
    ]);

    Route::post('/update-password', [
        'uses' => 'PegawaiController@change',
        'as' => 'u-pass'
    ]);

    Route::group(['prefix' => 'surat-keluar'], function (){

        Route::get('/', [
            'uses' => 'SuratKeluarController@index',
            'as' => 'surk-home'
        ]);

        Route::get('/data-surat-keluar-tambah', [
            'uses' => 'SuratKeluarController@create',
            'as' => 'surk-tambah'
        ]);

        Route::post('/tambah-surat-keluar', [
            'uses' => 'SuratKeluarController@store',
            'as' => 'surk-tambah-selesai'
        ]);

        Route::get('/surat-keluar-edit', [
            'uses' => 'SuratKeluarController@edit',
            'as' => 'surk-edit'
        ]);

        Route::post('/update-surat-keluar/{id}', [
            'uses' => 'SuratKeluarController@update',
            'as' => 'surk-update'
        ]);

        Route::delete('/hapus-surat-keluar/{id}', [
            'uses' => 'SuratKeluarController@destroy',
            'as' => 'surk-hapus'
        ]);

        Route::get('/surat-keluar-print', [
            'uses' => 'SuratKeluarController@print',
            'as' => 'surk-print'
        ]);

        Route::get('/surat-keluar-print-all', [
            'uses' => 'SuratKeluarController@printAll',
            'as' => 'surk-print-all'
        ]);

        Route::post('/surat-keluar-kirim', [
            'uses' => 'SuratKeluarController@attach',
            'as' => 'surk-kirim'
        ]);

        Route::post('/surat-keluar-kirim-raw', [
            'uses' => 'SuratKeluarController@send',
            'as' => 'surk-raw'
        ]);

        Route::get('/search-kode/{Q}', [
            'uses' => 'SuratKeluarController@searchJabatan',
            'as' => 'surk-search'
        ]);

        Route::get('/test-print', [
            'uses' => 'SuratKeluarController@test',
            'as' => 'surk-test'
        ]);
    });

    Route::group(['prefix' => 'surat-masuk'], function (){

        Route::get('/', [
            'uses' => 'SuratMasukController@index',
            'as' => 'surm-home'
        ]);

        Route::get('/data-surat-masuk-tambah', [
            'uses' => 'SuratMasukController@create',
            'as' => 'surm-tambah'
        ]);

        Route::post('/tambah-surat-masuk', [
            'uses' => 'SuratMasukController@store',
            'as' => 'surm-tambah-selesai'
        ]);

        Route::get('/surat-masuk-edit', [
            'uses' => 'SuratMasukController@edit',
            'as' => 'surm-edit'
        ]);

        Route::post('/update-surat-masuk/{id}', [
            'uses' => 'SuratMasukController@update',
            'as' => 'surm-update'
        ]);

        Route::get('/surat-masuk-print', [
            'uses' => 'SuratMasukController@print',
            'as' => 'surm-print'
        ]);

        Route::get('/surat-masuk-print-all', [
            'uses' => 'SuratMasukController@printAll',
            'as' => 'surm-print-all'
        ]);

        Route::post('/surat-masuk-kirim', [
            'uses' => 'SuratMasukController@attach',
            'as' => 'surm-kirim'
        ]);

        Route::delete('/hapus-surat-masuk/{id}', [
            'uses' => 'SuratMasukController@destroy',
            'as' => 'surm-hapus'
        ]);

    });

    Route::group(['prefix' => 'jadwal-pelajaran'], function (){

        Route::get('/qis', [
            'uses' => 'JadwalPelajaranController@indexQIS',
            'as' => 'jadwal.qis'
        ]);

        Route::get('/mdc', [
            'uses' => 'JadwalPelajaranController@indexMDC',
            'as' => 'jadwal.mdc'
        ]);

        Route::get('/abk', [
            'uses' => 'JadwalPelajaranController@indexABK',
            'as' => 'jadwal.abk'
        ]);

        Route::get('/jadwal-mdc-tambah', [
            'uses' => 'JadwalPelajaranController@createMdc',
            'as' => 'mdc-tambah'
        ]);

        Route::post('/tambah-jadwal-mdc', [
            'uses' => 'JadwalPelajaranController@storeMdc',
            'as' => 'mdc-tambah-selesai'
        ]);

        Route::get('/jadwal-mdc-edit', [
            'uses' => 'JadwalPelajaranController@editMdc',
            'as' => 'mdc-edit'
        ]);

        Route::post('/update-jadwal-mdc', [
            'uses' => 'JadwalPelajaranController@updateMdc',
            'as' => 'mdc-update'
        ]);

        Route::delete('/hapus-jadwal-mdc/{id}', [
            'uses' => 'JadwalPelajaranController@destroyMdc',
            'as' => 'mdc-hapus'
        ]);

        Route::delete('/hapus-jadwal-mdc-/{id}', [
            'uses' => 'JadwalPelajaranController@destroyJadwalMdc',
            'as' => 'mdc-j-hapus'
        ]);

        Route::get('jadwal-peserta-didik-qis', [
            'uses' => 'JadwalPelajaranController@getJadwalQIS',
            'as' => 'get.jadwal.qis',
        ]);

        Route::get('jadwal-peserta-didik-mdc', [
            'uses' => 'JadwalPelajaranController@getJadwalMDC',
            'as' => 'get.jadwal.mdc',
        ]);

        Route::get('jadwal-peserta-didik-abk', [
            'uses' => 'JadwalPelajaranController@getJadwalABK',
            'as' => 'get.jadwal.abk',
        ]);

        Route::get('jadwal-peserta-didik-qis', [
            'uses' => 'JadwalPelajaranController@getJadwalQIS',
            'as' => 'get.jadwal.qis',
        ]);

        Route::get('/jadwal-mdc-print', [
            'uses' => 'JadwalPelajaranController@print',
            'as' => 'mdc-print'
        ]);

        Route::get('/jadwal-mdc-print-all', [
            'uses' => 'JadwalPelajaranController@print_all',
            'as' => 'mdc-print-all'
        ]);

        Route::get('/modal-jadwal-mdc/{id}', [
            'uses' => 'JadwalPelajaranController@modalJadwal',
            'as' => 'modal-jadwal'
        ]);
    });

    Route::group(['prefix' => 'data-pegawai'], function (){

        Route::get('/', [
            'uses' => 'DataPegawaiController@index',
            'as' => 'd-pegawai'
        ]);

        Route::get('/tambah-pegawai', [
            'uses' => 'DataPegawaiController@create',
            'as' => 'd-p-tambah'
        ]);

        Route::get('/jabatan', [
            'uses' => 'DataPegawaiController@jabatan',
            'as' => 'json-jabatan'
        ]);

        Route::post('/tambah-pegawai', [
            'uses' => 'DataPegawaiController@store',
            'as' => 't-d-pegawai'
        ]);

        Route::get('/edit-pegawai', [
            'uses' => 'DataPegawaiController@edit',
            'as' => 'd-p-edit'
        ]);

        Route::post('/update-pegawai/{id}', [
            'uses' => 'DataPegawaiController@update',
            'as' => 'u-d-pegawai'
        ]);

        Route::get('/tambah-pendidikan-pegawai', [
            'uses' => 'DataPegawaiController@create_r',
            'as' => 'd-p-tambah-r'
        ]);

        Route::post('/tambah-pendidikan-pegawai', [
            'uses' => 'DataPegawaiController@store_r',
            'as' => 't-d-p-pegawai'
        ]);

        Route::get('/edit-pendidikan', [
            'uses' => 'DataPegawaiController@edit_r',
            'as' => 'd-p-edit-r'
        ]);

        Route::post('/update-pendidikan', [
            'uses' => 'DataPegawaiController@update_r',
            'as' => 'u-d-p-pegawai'
        ]);

        Route::delete('/hapus/{id}', [
            'uses' => 'DataPegawaiController@destroy',
            'as' => 'h-d-p-pegawai'
        ]);

        Route::delete('/hapus-semua}', [
            'uses' => 'DataPegawaiController@destroyAll',
            'as' => 'h-s-pegawai'
        ]);

        Route::get('/data-pegawai-berhasil-ditambahkan', [
            'uses' => 'DataPegawaiController@tambah_dpd',
            'as' => 'd-p-done'
        ]);

        Route::get('/pegawai-print', [
            'uses' => 'DataPegawaiController@print',
            'as' => 'd-p-print'
        ]);

        Route::get('/pegawai-print-all', [
            'uses' => 'DataPegawaiController@print_all',
            'as' => 'd-p-print-all'
        ]);

        Route::get('import-pegawai', [
            'uses' => 'DataPegawaiController@getPegawai',
            'as' => 'get.pegawai',
        ]);

        Route::get('import-pegawai-abk', [
            'uses' => 'DataPegawaiController@getPegawaiABK',
            'as' => 'get.pegawai.abk',
        ]);

        Route::get('import-pegawai-qis', [
            'uses' => 'DataPegawaiController@getPegawaiQIS',
            'as' => 'get.pegawai.qis',
        ]);
    });

    Route::group(['prefix' => 'peserta-didik'], function (){

        Route::get('/', [
            'uses' => 'PesertaController@index',
            'as' => 'p-home'
        ]);

        Route::get('/data-peserta-tambah', [
            'uses' => 'PesertaController@create',
            'as' => 'p-tambah'
        ]);

        Route::get('/kabupaten', [
            'uses' => 'PesertaController@kabupaten',
            'as' => 'json-kabupaten'
        ]);

            Route::get('/kecamatan', [
                'uses' => 'PesertaController@kecamatan',
                'as' => 'json-kecamatan'
            ]);

        Route::post('/tambah-peserta', [
            'uses' => 'PesertaController@store',
            'as' => 'p-tambah-peserta'
        ]);

        Route::get('/peserta-edit', [
            'uses' => 'PesertaController@edit',
            'as' => 'p-edit'
        ]);

        Route::post('/update-peserta/{id}', [
            'uses' => 'PesertaController@update',
            'as' => 'p-update'
        ]);

        Route::delete('/hapus-peserta/{id}', [
            'uses' => 'PesertaController@destroy',
            'as' => 'p-hapus'
        ]);

        Route::get('/peserta-print', [
            'uses' => 'PesertaController@print',
            'as' => 'p-print'
        ]);

        Route::get('/peserta-print-all', [
            'uses' => 'PesertaController@print_all',
            'as' => 'p-print-all'
        ]);

        Route::get('/nilai-peserta/{id}', [
            'uses' => 'PesertaController@lihatNilai',
            'as' => 'p-nilai'
        ]);

        Route::get('/nilai-peserta-print', [
            'uses' => 'PesertaController@printNilai',
            'as' => 'p-n-print'
        ]);

        Route::post('/sertifikat-kirim', [
            'uses' => 'PesertaController@attach',
            'as' => 'p-kirim'
        ]);

        Route::get('siswa-mdc', [
            'uses' => 'PesertaController@getSiswa',
            'as' => 'get.siswa',
        ]);

        Route::get('siswa-abk', [
            'uses' => 'PesertaController@getSiswaABK',
            'as' => 'get.siswa.abk',
        ]);

        Route::get('siswa-qis', [
            'uses' => 'PesertaController@getSiswaQIS',
            'as' => 'get.siswa.qis',
        ]);

    });

    Route::group(['prefix' => 'dokumen'], function (){

        Route::get('/', [
            'uses' => 'DokumenController@index',
            'as' => 'd-home'
        ]);

        Route::get('/dokumen-show', [
            'uses' => 'DokumenController@show',
            'as' => 'd-show'
        ]);

        Route::get('/dokumen-download', [
            'uses' => 'DokumenController@download',
            'as' => 'd-download'
        ]);

        Route::get('/data-dokumen-tambah', [
            'uses' => 'DokumenController@create',
            'as' => 'd-tambah'
        ]);

        Route::post('/tambah-dokumen', [
            'uses' => 'DokumenController@store',
            'as' => 'd-tambah-selesai'
        ]);

        Route::get('/dokumen-edit', [
            'uses' => 'DokumenController@edit',
            'as' => 'd-edit'
        ]);

        Route::post('/update-dokumen/{id}', [
            'uses' => 'DokumenController@update',
            'as' => 'd-update'
        ]);

        Route::delete('/hapus-dokumen/{id}', [
            'uses' => 'DokumenController@destroy',
            'as' => 'd-hapus'
        ]);

        Route::post('/dokumen-kirim', [
            'uses' => 'DokumenController@attach',
            'as' => 'd-kirim'
        ]);

        Route::post('/dokumen-kirim-raw', [
            'uses' => 'DokumenController@send',
            'as' => 'd-raw'
        ]);
    });

});
