<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $mahasiswa;
    public $defaultPassword;

    public function __construct($mahasiswa, $defaultPassword)
    {
        $this->mahasiswa = $mahasiswa;
        $this->defaultPassword = $defaultPassword;
    }

    public function build()
    {
        return $this->markdown('auth.password_reset_success')
            ->subject('Password Berhasil Direset');
    }
}
