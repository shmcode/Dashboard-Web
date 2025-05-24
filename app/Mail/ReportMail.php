<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReportMail extends Mailable
{
    use Queueable, Serializesmodels;

    public $reportData;
    public $cities;
    public $citizens;

    /**
     * Create a new message instance.
     */
    public function __construct($cities, $citizens)
    {
        $this->cities = $cities;
        $this->citizens = $citizens;
    }   

    public function build()
    {
        return $this->subject(__('Report'))
                    ->view('emails.report')
                    ->with([
                        'reportData' => $this->reportData,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Report Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.report',
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
