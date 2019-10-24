<?php namespace Igniter\Frontend;

use Validator;

class Extension extends \System\Classes\BaseExtension
{
    public function boot()
    {
        $this->addCaptchaValidationRule();
    }

    public function register()
    {
        $this->registerReCaptcha();
    }

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
            'Igniter\Frontend\Components\Captcha' => [
                'code' => 'captcha',
                'name' => 'lang:igniter.frontend::default.captcha.component_title',
                'description' => 'lang:igniter.frontend::default.captcha.component_desc',
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
            'captchasettings' => [
                'label' => 'reCaptcha Settings',
                'description' => 'Manage google reCAPTCHA settings.',
                'icon' => '',
                'model' => 'Igniter\Frontend\Models\CaptchaSettings',
            ],
            'mailchimpsettings' => [
                'label' => 'Mailchimp Settings',
                'description' => 'Manage Mailchimp API settings.',
                'icon' => '',
                'model' => 'Igniter\Frontend\Models\MailchimpSettings',
            ],
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'igniter.frontend::mail.contact' => 'Contact form email to admin',
        ];
    }

    protected function registerReCaptcha()
    {
        $this->app->singleton('recaptcha', function ($app) {
            $settings = Models\CaptchaSettings::instance();

            return new Classes\ReCaptcha(
                $settings->get('api_secret_key'),
                $settings->get('version')
            );
        });
    }

    /**
     * Extends Validator to include a recaptcha type
     */
    protected function addCaptchaValidationRule()
    {
        Validator::extendImplicit('recaptcha', function ($attribute, $value, $parameters, $validator) {
            return app('recaptcha')->verifyResponse($value);
        }, 'igniter.frontend::default.captcha.error_recaptcha');
    }
}
