<?php

// namespace App\Mail;

// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Mail\Mailable;
// use Illuminate\Mail\Mailables\Attachment;
// use Illuminate\Mail\Mailables\Content;
// use Illuminate\Mail\Mailables\Envelope;
// use Illuminate\Queue\SerializesModels;
// use App\Models\Partage;

// class PartageInvitation extends Mailable
// {
//     use Queueable, SerializesModels;

//     public Partage $partage;

//     /**
//      * Create a new message instance.
//      */
//     public function __construct()
//     {
//         $this->partage = $partage;
//     }

//     /**
//      * Get the message envelope.
//      */
//     public function envelope(): Envelope
//     {
//         return new Envelope(
//             subject: 'Partage Invitation',
//         );
//     }

//     /**
//      * Get the message content definition.
//      */
//     public function content(): Content
//     {
//         return new Content(
//             view: 'view.name',
//         );
//     }

//     /**
//      * Get the attachments for the message.
//      *
//      * @return array<int, Attachment>
//      */
//     public function attachments(): array
//     {
//         return [];
//     }

//     public function build()
//     {
//         return $this->subject('Invitation à partager un compte Budgie')
//             ->view('emails.partage', [
//                 'partage' => $this->partage,
//                 'lien' => route('partages.accept', ['token' => $this->partage->token]),
//             ]);
//     }
// }




namespace App\Mail;

use App\Models\Partage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PartageInvitation extends Mailable
{
    use Queueable, SerializesModels;

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