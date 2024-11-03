<?php

namespace Igniter\Frontend\Tests\Actions;

use Igniter\Frontend\Actions\SendContactMail;
use Igniter\System\Mail\AnonymousTemplateMailable;
use Illuminate\Support\Facades\Mail;

beforeEach(function() {
    $this->data = ['name' => 'John Doe', 'email' => 'john@example.com', 'message' => 'Hello'];
});

it('queues contact mail with correct data', function() {
    Mail::fake();

    (new SendContactMail())($this->data);

    Mail::assertQueued(AnonymousTemplateMailable::class, function($mail) {
        return $mail->getTemplateCode() === 'igniter.frontend::mail.contact';
    });
});
