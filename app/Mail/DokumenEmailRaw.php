<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DokumenEmailRaw extends Mailable
{
    use Queueable, SerializesModels;
    public $request, $files;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $files)
    {
        $this->request = $request;
        $this->files = $files;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->request;
        $files = $this->files;

        $message = $this->to($data->penerima)
            ->from(env('MAIL_USERNAME'), 'QIS - Quali International Surabaya')
            ->subject($data->subjek)
            ->view('mail.m-personal' ,compact('data'));

        foreach ($files as $index => $file){
            $message->attach(public_path('file-dokumen/'.$file));
        }

        return $message;
    }
}
