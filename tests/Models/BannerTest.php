<?php

namespace Igniter\Frontend\Tests\Models;

use Igniter\Frontend\Models\Banner;
use Igniter\System\Models\Concerns\Switchable;

it('returns type label attribute', function() {
    $banner = Banner::make(['type' => 'image']);

    expect($banner->type_label)->toBe('Image');
});

it('returns image thumb', function() {
    $banner = Banner::make(['image_code' => serialize(['path' => 'banner.jpg'])]);

    expect($banner->getImageThumb([
        'no_photo' => 'no_photo.jpg',
    ]))->toContain('banner.jpg');
});

it('returns image thumb with no photo', function() {
    $banner = Banner::make(['image_code' => serialize(['path' => ''])]);

    expect($banner->getImageThumb(['no_photo' => 'no_photo.jpg']))->toContain('no_photo.jpg');
});

it('configures banner model correctly', function() {
    $banner = new Banner;

    expect(class_uses_recursive($banner))
        ->toContain(Switchable::class)
        ->and($banner->getTable())->toBe('igniter_frontend_banners')
        ->and($banner->getKeyName())->toBe('banner_id')
        ->and($banner->getFillable())->toContain('name', 'type', 'click_url', 'language_id', 'alt_text', 'image_code', 'custom_code', 'status')
        ->and($banner->relation['belongsTo'])->toBe([
            'language' => \Igniter\System\Models\Language::class,
        ])
        ->and($banner->getCasts())->toBe([
            'banner_id' => 'int',
            'image_code' => 'serialize',
            'language_id' => 'integer',
            'status' => 'boolean',
        ]);
});
