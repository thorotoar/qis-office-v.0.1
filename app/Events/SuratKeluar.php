<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class SuratKeluar
{
    use Dispatchable, SerializesModels;
    public $email, $file, $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email, $file, $request)
    {
        $this->email = $email;
        $this->file = $file;
        $this->request = $request;
    }
}
