<?php

namespace App\Mail;

use App\Models\Issuance;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IssuanceStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $issuance;
    public $statusMessage;

    public function __construct(Issuance $issuance, $statusMessage)
    {
        $this->issuance = $issuance;
        $this->statusMessage = $statusMessage;
    }

    public function build()
    {
        return $this->view('emails.issuance-status')
            ->subject('Изменение статуса книги')
            ->with([
                'reader' => $this->issuance->reader,
                'book' => $this->issuance->book,
                'statusMessage' => $this->statusMessage,
            ]);
    }
}
