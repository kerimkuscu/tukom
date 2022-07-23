<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $body;

    public string $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public array $mailData)
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->body  = $this->mailData['body'];
        $this->title = $this->mailData['title'];

        return
            $this->markdown('vendor.mail.html.message')
                ->from($this->mailData['from'], setting('smtp.form.name') ?? config('app.name'))
                ->subject($this->mailData['subject']);
    }
}
