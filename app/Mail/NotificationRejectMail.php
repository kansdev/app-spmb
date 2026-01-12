<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationRejectMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nomor_pendaftaran;
    protected $registrasi;
    /**
     * Create a new message instance.
     */
    public function __construct($registrasi)
    {
        $this->registrasi = $registrasi;
        $this->nomor_pendaftaran = $registrasi->nomor_pendaftaran;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notifikasi Registrasi Di Tolak',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.notif',
            with: [
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
        return [];
    }
}
