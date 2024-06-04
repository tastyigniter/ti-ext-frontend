<?php

namespace Igniter\Frontend\Tests;

use Igniter\Frontend\Extension;

it('registers permissions', function() {
    $extension = new Extension(app());

    $permissions = $extension->registerPermissions();

    expect($permissions)->toHaveKeys([
        'Igniter.FrontEnd.ManageSettings',
        'Igniter.FrontEnd.ManageBanners',
        'Igniter.FrontEnd.ManageSlideshow',
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
