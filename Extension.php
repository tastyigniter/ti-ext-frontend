<?php namespace SamPoyigi\FrontEnd;

class Extension extends \System\Classes\BaseExtension
{
    public function registerComponents()
    {
        return [
            'SamPoyigi\FrontEnd\Components\Banners'       => [
                'code'        => 'banners',
                'name'        => 'lang:sampoyigi.frontend::default.banners.component_title',
                'description' => 'lang:sampoyigi.frontend::default.banners.component_desc',
            ],
            'SamPoyigi\FrontEnd\Components\Contact'       => [
                'code'        => 'contact',
                'name'        => 'lang:sampoyigi.frontend::default.contact.component_title',
                'description' => 'lang:sampoyigi.frontend::default.contact.component_desc',
            ],
            'SamPoyigi\FrontEnd\Components\Slider'        => [
                'code'        => 'slider',
                'name'        => 'lang:sampoyigi.frontend::default.slider.component_title',
                'description' => 'lang:sampoyigi.frontend::default.slider.component_desc',
            ],
            'SamPoyigi\FrontEnd\Components\Newsletter'    => [
                'code'        => 'newsletter',
                'name'        => 'lang:sampoyigi.frontend::default.newsletter.component_title',
                'description' => 'lang:sampoyigi.frontend::default.newsletter.component_desc',
            ],
            'SamPoyigi\FrontEnd\Components\FeaturedItems' => [
                'code'        => 'featuredItems',
                'name'        => 'lang:sampoyigi.frontend::default.featured.component_title',
                'description' => 'lang:sampoyigi.frontend::default.featured.component_desc',
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'marketing' => [
                'child' => [
                    'banners' => [
                        'priority'   => 30,
                        'class'      => 'pages',
                        'href'       => admin_url('sampoyigi/frontend/banners'),
                        'title'      => lang('admin::lang.side_menu.banner'),
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
                'action'      => ['manage'],
            ],
            'Module.Slideshow'     => [
                'action'      => ['manage'],
                'description' => 'Ability to manage homepage slide show module',
            ],
            'Module.FeaturedItems' => [
                'action'      => ['manage'],
                'description' => 'Ability to manage featured menu module',
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'slidersettings' => [
                'label'       => 'Slider Settings',
                'description' => 'Manage slider settings.',
                'icon'        => '',
                'model'       => 'SamPoyigi\FrontEnd\Models\SliderSettings',
                'permissions' => ['Module.Slideshow'],
            ],
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'sampoyigi.frontend::mail.contact' => 'Contact form email to admin',
        ];
    }
}
