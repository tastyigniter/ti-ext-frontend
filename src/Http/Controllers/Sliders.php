<?php

namespace Igniter\Frontend\Http\Controllers;

use Igniter\Admin\Facades\AdminMenu;

class Sliders extends \Igniter\Admin\Classes\AdminController
{
    public $implement = [
        \Igniter\Admin\Http\Actions\ListController::class,
        \Igniter\Admin\Http\Actions\FormController::class,
    ];

    public $listConfig = [
        'list' => [
            'model' => \Igniter\Frontend\Models\Slider::class,
            'title' => 'lang:igniter.frontend::default.slider.text_title',
            'emptyMessage' => 'lang:igniter.frontend::default.slider.text_empty',
            'defaultSort' => ['id', 'DESC'],
            'configFile' => 'slider',
        ],
    ];

    public $formConfig = [
        'name' => 'lang:igniter.frontend::default.slider.text_form_name',
        'model' => \Igniter\Frontend\Models\Slider::class,
        'create' => [
            'title' => 'lang:admin::lang.form.create_title',
            'redirect' => 'igniter/frontend/sliders/edit/{id}',
            'redirectClose' => 'igniter/frontend/sliders',
            'redirectNew' => 'igniter/frontend/sliders/create',
        ],
        'edit' => [
            'title' => 'lang:admin::lang.form.edit_title',
            'redirect' => 'igniter/frontend/sliders/edit/{id}',
            'redirectClose' => 'igniter/frontend/sliders',
            'redirectNew' => 'igniter/frontend/sliders/create',
        ],
        'preview' => [
            'title' => 'lang:admin::lang.form.preview_title',
            'back' => 'igniter/frontend/sliders',
        ],
        'delete' => [
            'redirect' => 'igniter/frontend/sliders',
        ],
        'configFile' => 'slider',
    ];

    protected $requiredPermissions = 'Igniter.FrontEnd.ManageSlideshow';

    public function __construct()
    {
        parent::__construct();

        AdminMenu::setContext('sliders', 'design');
    }
}
