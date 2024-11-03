<?php

namespace Igniter\Frontend\Tests\Models;

use Igniter\Frontend\Models\Subscriber;
use Illuminate\Support\Facades\Event;

it('subscribes an email', function() {
    Event::fake();

    $email = 'email@example.com';
    $subscriber = Subscriber::subscribe($email);

    expect($subscriber->email)->toBe($email);
    Event::assertDispatched('igniter.frontend.subscribed');
});

it('configures subscriber model correctly', function() {
    $slider = new Subscriber();

    expect($slider->getTable())->toBe('igniter_frontend_subscribers')
        ->and($slider->getKeyName())->toBe('id')
        ->and($slider->getFillable())->toBe(['email']);
});
