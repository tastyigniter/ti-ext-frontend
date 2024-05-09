<?php

namespace Igniter\Frontend\Http\Controllers;

use Igniter\Admin\Facades\AdminMenu;
use Illuminate\Validation\Rule;

class Banners extends \Igniter\Admin\Classes\AdminController
{
    public array $implement = [
        \Igniter\Admin\Http\Actions\ListController::class,
        \Igniter\Admin\Http\Actions\FormController::class,
    ];

    public array $listConfig = [
        'list' => [
            'model' => \Igniter\Frontend\Models\Banner::class,
            'title' => 'lang:igniter.frontend::default.banners.text_title',
            'emptyMessage' => 'lang:igniter.frontend::default.banners.text_empty',
            'defaultSort' => ['banner_id', 'DESC'],
            'configFile' => 'banner',
        ],
    ];

    public array $formConfig = [
        'name' => 'lang:igniter.frontend::default.banners.text_form_name',
        'model' => \Igniter\Frontend\Models\Banner::class,
        'create' => [
            'title' => 'lang:admin::lang.form.create_title',
            'redirect' => 'igniter/frontend/banners/edit/{banner_id}',
            'redirectClose' => 'igniter/frontend/banners',
            'redirectNew' => 'igniter/frontend/banners/create',
        ],
        'edit' => [
            'title' => 'lang:admin::lang.form.edit_title',
            'redirect' => 'igniter/frontend/banners/edit/{banner_id}',
            'redirectClose' => 'igniter/frontend/banners',
            'redirectNew' => 'igniter/frontend/banners/create',
        ],
        'preview' => [
            'title' => 'lang:admin::lang.form.preview_title',
            'back' => 'igniter/frontend/banners',
        ],
        'delete' => [
            'redirect' => 'igniter/frontend/banners',
        ],
        'configFile' => 'banner',
    ];

    protected null|string|array $requiredPermissions = 'Igniter.FrontEnd.ManageBanners';

    public function __construct()
    {
        parent::__construct();

        AdminMenu::setContext('sliders', 'design');
    }

    public function formValidate($model, $form)
    {
        $namedRules = [
            ['name', 'lang:admin::lang.label_name', 'required|min:2|max:255'],
            ['code', 'lang:admin::lang.label_code', ['required', 'alpha_dash', 'min:2', 'max:255',
                Rule::unique($model->getTable(), 'code')->ignore($model->getKey(), 'banner_id'),
            ]],
            ['type', 'lang:igniter.frontend::default.banners.label_type', 'sometimes|required|alpha|max:8'],
            ['custom_code', 'lang:igniter.frontend::default.banners.label_custom_code', 'required_if:type,custom'],
            ['click_url', 'lang:igniter.frontend::default.banners.label_click_url', 'required_if:type,image|url|min:2|max:255'],
            ['alt_text', 'lang:igniter.frontend::default.banners.label_alt_text', 'required_if:type,image|min:2|max:255'],
            ['image_code', 'lang:igniter.frontend::default.banners.label_image', 'required_if:type,image'],
            ['language_id', 'lang:igniter.frontend::default.banners.label_language', 'required|integer'],
            ['status', 'lang:admin::lang.label_status', 'required|integer'],
        ];

        return $this->validate(post($form->arrayName), $namedRules);
    }
}
