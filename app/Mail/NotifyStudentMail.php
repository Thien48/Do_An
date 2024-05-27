<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyStudentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $content;

    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function build()
    {
        return $this->subject($this->title)
                    ->view('emails.notify-student')
                    ->with([
                        'content' => $this->content,
                    ]);
    }
}
