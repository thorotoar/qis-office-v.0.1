<?php

namespace App\Listeners;

use App\Events\SuratKeluar;
use App\Mail\SuratKeluarEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class KirimSuratKeluar
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SuratKeluar  $event
     * @return void
     */
    public function handle(SuratKeluar $event)
    {
        Mail::to($event->email)->send(new SuratKeluarEmail($event->file));
    }
}
