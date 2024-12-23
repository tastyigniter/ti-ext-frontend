<?php

namespace Igniter\Frontend\Tests;

use DrewM\MailChimp\MailChimp;
use Igniter\Frontend\Classes\ReCaptcha;
use Igniter\Frontend\Extension;
use Igniter\Frontend\Models\MailchimpSettings;
use Illuminate\Support\Facades\Validator;

it('creates mailchimp service correctly', function() {
    MailchimpSettings::set([
        'api_key' => 'some-api-key',
        'list_id' => 'some_list_id',
    ]);

    $service = resolve(MailChimp::class);

    expect($service)->toBeInstanceOf(MailChimp::class);
});

it('creates recaptcha service correctly', function() {
    $service = resolve('recaptcha');

    expect($service)->toBeInstanceOf(ReCaptcha::class);
});

it('registers recaptcha validation rule correctly', function() {
    $recaptcha = mock(ReCaptcha::class);
    $recaptcha->shouldReceive('verifyResponse')->andReturnTrue()->once();
    app()->instance('recaptcha', $recaptcha);

    $validated = Validator::make(['g-recaptcha-response' => 'token'], [
        'g-recaptcha-response' => 'required|recaptcha',
    ])->passes();

    expect($validated)->toBeTrue();
});

it('registers permissions', function() {
    $extension = new Extension(app());

    $permissions = $extension->registerPermissions();

    expect($permissions)->toHaveKeys([
        'Igniter.FrontEnd.ManageSettings',
        'Igniter.FrontEnd.ManageBanners',
        'Igniter.FrontEnd.ManageSlideshow',
    ]);
});

it('registers system settings', function() {
    $extension = new Extension(app());

    $result = $extension->registerSettings();

    expect($result)->toHaveKey('captchasettings')
        ->and($result['captchasettings'])->toMatchArray([
            'label' => 'reCaptcha Settings',
            'description' => 'Manage google reCAPTCHA settings.',
            'icon' => 'fa fa-gear',
            'model' => \Igniter\Frontend\Models\CaptchaSettings::class,
            'permissions' => ['Igniter.FrontEnd.ManageSettings'],
        ])
        ->and($result)->toHaveKey('mailchimpsettings')
        ->and($result['mailchimpsettings'])->toMatchArray([
            'label' => 'Mailchimp Settings',
            'description' => 'Manage Mailchimp API settings.',
            'icon' => 'fa fa-gear',
            'model' => \Igniter\Frontend\Models\MailchimpSettings::class,
            'permissions' => ['Igniter.FrontEnd.ManageSettings'],
        ]);
});


it('registers navigation', function() {
    $extension = new Extension(app());

    $navigation = $extension->registerNavigation();

    expect($navigation)->toHaveKeys(['design'])
        ->and($navigation['design']['child'])->toHaveKeys(['sliders']);
});

it('registers mail templates', function() {
    $extension = new Extension(app());

    $templates = $extension->registerMailTemplates();

    expect($templates)->toHaveKey('igniter.frontend::mail.contact');
});
