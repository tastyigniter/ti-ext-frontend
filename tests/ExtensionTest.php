<?php

declare(strict_types=1);

namespace Igniter\Frontend\Tests;

use DrewM\MailChimp\MailChimp;
use Igniter\Frontend\Classes\ReCaptcha;
use Igniter\Frontend\Extension;
use Igniter\Frontend\Models\CaptchaSettings;
use Igniter\Frontend\Models\MailchimpSettings;
use Illuminate\Support\Facades\Validator;

it('creates mailchimp service correctly', function(): void {
    MailchimpSettings::set([
        'api_key' => 'some-api-key',
        'list_id' => 'some_list_id',
    ]);

    $service = resolve(MailChimp::class);

    expect($service)->toBeInstanceOf(MailChimp::class);
});

it('creates recaptcha service correctly', function(): void {
    $service = resolve('recaptcha');

    expect($service)->toBeInstanceOf(ReCaptcha::class);
});

it('registers recaptcha validation rule correctly', function(): void {
    $recaptcha = mock(ReCaptcha::class);
    $recaptcha->shouldReceive('verifyResponse')->andReturnTrue()->once();
    app()->instance('recaptcha', $recaptcha);

    $validated = Validator::make(['g-recaptcha-response' => 'token'], [
        'g-recaptcha-response' => 'required|recaptcha',
    ])->passes();

    expect($validated)->toBeTrue();
});

it('registers permissions', function(): void {
    $extension = new Extension(app());

    $permissions = $extension->registerPermissions();

    expect($permissions)->toHaveKeys([
        'Igniter.FrontEnd.ManageSettings',
        'Igniter.FrontEnd.ManageBanners',
        'Igniter.FrontEnd.ManageSlideshow',
    ]);
});

it('registers system settings', function(): void {
    $extension = new Extension(app());

    $result = $extension->registerSettings();

    expect($result)->toHaveKey('captchasettings')
        ->and($result['captchasettings'])->toMatchArray([
            'label' => 'reCaptcha Settings',
            'description' => 'Manage google reCAPTCHA settings.',
            'icon' => 'fa fa-gear',
            'model' => CaptchaSettings::class,
            'permissions' => ['Igniter.FrontEnd.ManageSettings'],
        ])
        ->and($result)->toHaveKey('mailchimpsettings')
        ->and($result['mailchimpsettings'])->toMatchArray([
            'label' => 'Mailchimp Settings',
            'description' => 'Manage Mailchimp API settings.',
            'icon' => 'fa fa-gear',
            'model' => MailchimpSettings::class,
            'permissions' => ['Igniter.FrontEnd.ManageSettings'],
        ]);
});

it('registers navigation', function(): void {
    $extension = new Extension(app());

    $navigation = $extension->registerNavigation();

    expect($navigation)->toHaveKeys(['design'])
        ->and($navigation['design']['child'])->toHaveKeys(['sliders']);
});

it('registers mail templates', function(): void {
    $extension = new Extension(app());

    $templates = $extension->registerMailTemplates();

    expect($templates)->toHaveKey('igniter.frontend::mail.contact');
});
