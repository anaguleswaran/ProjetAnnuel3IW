<?php

namespace App\Mail;

use App\Models\Partage;
use Illuminate\Mail\Mailable;

class PartageInvitation extends Mailable
{

    public Partage $partage;

    public function __construct(Partage $partage)
    {
        $this->partage = $partage;
    }

    public function build()
    {
        return $this->subject('Invitation à partager un compte Budgie')
            ->view('emails.partage', [
                'partage' => $this->partage,
                'lien' => route('partages.accept', ['token' => $this->partage->token]),
            ]);
    }
}