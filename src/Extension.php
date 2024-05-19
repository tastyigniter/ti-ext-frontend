<?php

namespace Igniter\Frontend;

use DrewM\MailChimp\MailChimp;
use Igniter\Frontend\Models\MailchimpSettings;
use Illuminate\Support\Facades\Validator;

class Extension extends \Igniter\System\Classes\BaseExtension
{
    public function boot()
    {
        $this->addCaptchaValidationRule();
    }

    public function register()
    {
        $this->registerReCaptcha();

        $this->app->singleton(MailChimp::class, function() {
            return new MailChimp(MailChimpSettings::get('api_key'));
        });
    }

    public function registerNavigation(): array
    {
        return [
            'design' => [
                'child' => [
                    'sliders' => [
                        'priority' => 30,
                        'class' => 'sliders',
                        'href' => admin_url('igniter/frontend/sliders'),
                        'title' => lang('igniter.frontend::default.text_side_menu'),
                        'permission' => ['Igniter.FrontEnd.ManageBanners', 'Igniter.FrontEnd.ManageSlideshow'],
                    ],
                ],
            ],
        ];
    }

    public function registerPermissions(): array
    {
        return [
            'Igniter.FrontEnd.ManageSettings' => [
                'description' => 'Configure google recaptcha and mailchimp settings',
                'group' => 'igniter::admin.permissions.name',
            ],
            'Igniter.FrontEnd.ManageBanners' => [
                'description' => 'Create, modify and delete front-end banners',
                'group' => 'igniter::admin.permissions.name',
            ],
            'Igniter.FrontEnd.ManageSlideshow' => [
                'group' => 'igniter::admin.permissions.name',
                'description' => 'Create, modify and delete front-end sliders',
            ],
        ];
    }

    public function registerSettings(): array
    {
        return [
            'captchasettings' => [
                'label' => 'reCaptcha Settings',
                'description' => 'Manage google reCAPTCHA settings.',
                'icon' => 'fa fa-gear',
                'model' => \Igniter\Frontend\Models\CaptchaSettings::class,
                'permissions' => ['Igniter.FrontEnd.ManageSettings'],
            ],
            'mailchimpsettings' => [
                'label' => 'Mailchimp Settings',
                'description' => 'Manage Mailchimp API settings.',
                'icon' => 'fa fa-gear',
                'model' => \Igniter\Frontend\Models\MailchimpSettings::class,
                'permissions' => ['Igniter.FrontEnd.ManageSettings'],
            ],
        ];
    }

    public function registerMailTemplates(): array
    {
        return [
            'igniter.frontend::mail.contact' => 'Contact form email to admin',
        ];
    }

    protected function registerReCaptcha()
    {
        $this->app->singleton('recaptcha', function($app) {
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
        Validator::extendImplicit('recaptcha', function($attribute, $value, $parameters, $validator) {
            return app('recaptcha')->verifyResponse($value);
        }, lang('igniter.frontend::default.captcha.error_recaptcha'));
    }
}
