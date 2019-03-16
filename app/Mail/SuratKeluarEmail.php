<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SuratKeluarEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $request, $file;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $file)
    {
        $this->request = $request;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->request;
        return $this
            ->to($data->penerima)
            ->from(env('MAIL_USERNAME'), 'QIS - Quali International Surabaya')
            ->subject($data->subjek)
            ->attach(public_path('images/file-surat/'. $this->file))
            ->view('pegawai.surat-keluar.k-mail' ,compact('data'));
    }
}
