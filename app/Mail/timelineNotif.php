<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class timelineNotif extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    private $userName;
    private $projectName;
    private $taskName;
    private $toDate;
    
    public function __construct($userName, $projectName, $taskName, $toDate)
    {
        $this->userName = $userName;
        $this->projectName = $projectName;
        $this->taskName = $taskName;
        $this->toDate = $toDate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Deadline Task Project - '.$this->projectName ,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Mail.notifActivity',
            with:[
                "userName"=>$this->userName,
                "projectName"=>$this->projectName,
                "taskName"=>$this->taskName,
                "toDate"=>$this->toDate
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
