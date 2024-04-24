<?php

namespace Igniter\Frontend\Actions;

use Illuminate\Support\Facades\Mail;

class SendContactMail
{
    public function __invoke(array $data)
    {
        Mail::queueTemplate('igniter.frontend::mail.contact', $data, [
            setting('site_email'), setting('site_name'),
        ]);
    }
}
