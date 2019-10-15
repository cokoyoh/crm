<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SimpleMail extends Mailable
{
    use Queueable, SerializesModels, CrmMailable;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->data['view'])
            ->to($this->data['to'])
            ->subject($this->data['subject'])
            ->addCC($this, $this->data)
            ->addBCC($this, $this->data)
            ->with($this->data);
    }
}
