<?php namespace Igniter\Frontend;

class Extension extends \System\Classes\BaseExtension
{
    public function registerComponents()
    {
        return [
            'Igniter\Frontend\Components\Banners' => [
                'code' => 'banners',
                'name' => 'lang:igniter.frontend::default.banners.component_title',
                'description' => 'lang:igniter.frontend::default.banners.component_desc',
            ],
            'Igniter\Frontend\Components\Contact' => [
                'code' => 'contact',
                'name' => 'lang:igniter.frontend::default.contact.component_title',
                'description' => 'lang:igniter.frontend::default.contact.component_desc',
            ],
            'Igniter\Frontend\Components\Slider' => [
                'code' => 'slider',
                'name' => 'lang:igniter.frontend::default.slider.component_title',
                'description' => 'lang:igniter.frontend::default.slider.component_desc',
            ],
            'Igniter\Frontend\Components\Newsletter' => [
                'code' => 'newsletter',
                'name' => 'lang:igniter.frontend::default.newsletter.component_title',
                'description' => 'lang:igniter.frontend::default.newsletter.component_desc',
            ],
            'Igniter\Frontend\Components\FeaturedItems' => [
                'code' => 'featuredItems',
                'name' => 'lang:igniter.frontend::default.featured.component_title',
                'description' => 'lang:igniter.frontend::default.featured.component_desc',
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'marketing' => [
                'child' => [
                    'banners' => [
                        'priority' => 30,
                        'class' => 'pages',
                        'href' => admin_url('igniter/frontend/banners'),
                        'title' => lang('admin::lang.side_menu.banner'),
                        'permission' => 'Module.BannersModule',
                    ],
                ],
            ],
        ];
    }

    public function registerPermissions()
    {
        return [
            'Module.BannersModule' => [
                'description' => 'Ability to manage banners module',
                'group' => 'module',
            ],
            'Module.Slideshow' => [
                'group' => 'module',
                'description' => 'Ability to manage homepage slide show module',
            ],
            'Module.FeaturedItems' => [
                'group' => 'module',
                'description' => 'Ability to manage featured menu module',
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'slidersettings' => [
                'label' => 'Slider Settings',
                'description' => 'Manage slider settings.',
                'icon' => '',
                'model' => 'Igniter\Frontend\Models\SliderSettings',
                'permissions' => ['Module.Slideshow'],
            ],
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'igniter.frontend::mail.contact' => 'Contact form email to admin',
        ];
    }
}
