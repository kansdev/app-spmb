<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $nomor_pendaftaran;
    protected $registrasi;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $registrasi)
    {
        $this->user = $user;
        $this->registrasi = $registrasi;
        $this->nomor_pendaftaran = $registrasi->nomor_pendaftaran;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registrasi SPMB',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.mail',
            with: [
                'user' => $this->user,
                'registrasi' => $this->registrasi
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $pdf = Pdf::loadView('pdf.pendaftaran', [
            'registrasi' => $this->registrasi
        ]);

        return [
            Attachment::fromData(
                fn () => $pdf->output(),
                'Bukti Pendaftaran_' . $this->nomor_pendaftaran . '.pdf'
            )->withMime('application/pdf')
        ];
    }
}
