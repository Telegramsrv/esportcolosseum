<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\TicketConversation;

class TicketReplayMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $ticketConversation;
    protected $formEmail;
    protected $formName;
    
    public function __construct(TicketConversation $ticketConversation)
    {
        $this->ticketConversation = $ticketConversation;
        $this->formEmail = env('FROM_EMAIL');
        $this->formName = env('FROM_NAME');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.ticket-replay-email')->with(['ticket' => $this->ticketConversation])
        ->from($this->formEmail, $this->formName)
        ->subject($this->ticketConversation->subject, $this->formName);
    }
}
