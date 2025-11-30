<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContributionThankYouEmail extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $contributionType;
    public string $amount;
    public string $date;

    /**
     * Create a new message instance.
     */
    public function __construct(string $name, string $contributionType, string $amount, ?string $date = null)
    {
        $this->name = $name;
        $this->contributionType = $contributionType;
        $this->amount = $amount;
        $this->date = $date ?? now()->translatedFormat('d F Y');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Terima Kasih Atas Kontribusi Anda - Asosiasi Alumni DRM',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contribution-thank-you',
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
