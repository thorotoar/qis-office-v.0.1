<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SuratKeluarEmailRaw extends Mailable
{
    use Queueable, SerializesModels;
    public $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
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
            ->attachData($data->file_pdf, 'file_qis.pdf', [
                'mime' => 'application/pdfapplication/pdf,application/msword,application/vnd.openxmlformats-officedocument.presentationml.presentation',
            ])
            ->view('mail.m-personal' ,compact('data'));
    }
}
