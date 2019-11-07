<?php

namespace App\Mail;

trait CrmMailable
{
    public function addCC($mailable, $data)
    {
        if (isset($data['cc']) && inProduction()) {
            return $mailable->cc($data['cc']);
        }

        return $mailable;
    }


    public function addBcc($mailable, $data)
    {
        if (isset($data['bcc']) && inProduction()) {
            $mailable->bcc(array_merge($data['bcc'], getAdmins()));
        } else {
            $mailable->bcc(getAdmins());
        }

        return $mailable;
    }

    public function addAttachment($mailable, $data)
    {
        if (isset($data['attach'])) {
            if (is_array($data['attach'])) {
                foreach ($data['attach'] as $attachment) {
                    $mailable->attach($attachment);
                }
            } else {
                $mailable->attach($data['attach']);
            }
        }

        return $mailable;
    }
}
