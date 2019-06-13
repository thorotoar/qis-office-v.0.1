<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DokumenEmail extends Mailable
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
        $file = $this->file;

//        dd($file);

        $message = $this->to($data->penerima)
            ->from(env('MAIL_USERNAME'), 'QIS - Quali International Surabaya')
            ->subject($data->subjek)
            ->view('mail.m-personal' ,compact('data'));

        foreach ($file as $files){
//            dd($files['upload_file']);
            $message->attach(public_path($files['upload_file']));
        }

        return $message;
    }
}
