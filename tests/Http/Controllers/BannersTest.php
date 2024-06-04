<?php

namespace Igniter\Frontend\Tests\Http\Controllers;

use Igniter\Frontend\Models\Banner;

it('loads banners page', function() {
    actingAsSuperUser()
        ->get(route('igniter.frontend.banners'))
        ->assertOk();
});

it('loads create banner page', function() {
    actingAsSuperUser()
        ->get(route('igniter.frontend.banners', ['slug' => 'create']))
        ->assertOk();
});

it('loads edit banner page', function() {
    $banner = Banner::create();

    actingAsSuperUser()
        ->get(route('igniter.frontend.banners', ['slug' => 'edit/'.$banner->getKey()]))
        ->assertOk();
});

it('loads banner preview page', function() {
    $banner = Banner::create();

    actingAsSuperUser()
        ->get(route('igniter.frontend.banners', ['slug' => 'preview/'.$banner->getKey()]))
        ->assertOk();
});

it('creates banner', function() {
    actingAsSuperUser()
        ->post(route('igniter.frontend.banners', ['slug' => 'create']), [
            'Banner' => [
                'name' => 'Created Banner',
                'code' => 'banner-code',
                'custom_code' => '<h1>Updated Banner</h1>',
                'language_id' => 1,
                'status' => 1,
            ],
        ], [
            'X-Requested-With' => 'XMLHttpRequest',
            'X-IGNITER-REQUEST-HANDLER' => 'onSave',
        ]);

    expect(Banner::where('name', 'Created Banner')->exists())->toBeTrue();
});

it('updates banner', function() {
    $banner = Banner::create();

    actingAsSuperUser()
        ->post(route('igniter.frontend.banners', ['slug' => 'edit/'.$banner->getKey()]), [
            'Banner' => [
                'name' => 'Updated Banner',
                'code' => 'banner-code',
                'custom_code' => '<h1>Updated Banner</h1>',
                'language_id' => 1,
                'status' => 1,
            ],
        ], [
            'X-Requested-With' => 'XMLHttpRequest',
            'X-IGNITER-REQUEST-HANDLER' => 'onSave',
        ]);

    expect(Banner::where('name', 'Updated Banner')->exists())->toBeTrue();
});

it('deletes banner', function() {
    $banner = Banner::create();

    actingAsSuperUser()
        ->post(route('igniter.frontend.banners', ['slug' => 'edit/'.$banner->getKey()]), [], [
            'X-Requested-With' => 'XMLHttpRequest',
            'X-IGNITER-REQUEST-HANDLER' => 'onDelete',
        ]);

    expect(Banner::find($banner->getKey()))->toBeNull();
});

