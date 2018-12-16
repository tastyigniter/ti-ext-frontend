<?php
$config['list']['filter'] = [
    'search' => [
        'prompt' => 'lang:igniter.frontend::default.banners.text_filter_search',
        'mode' => 'all' // or any, exact
    ],
    'scopes' => [
        'status' => [
            'label' => 'lang:igniter.frontend::default.banners.text_filter_status',
            'type' => 'switch',
            'conditions' => 'status = :filtered',
        ],
    ],
];

$config['list']['toolbar'] = [
    'buttons' => [
        'create' => [
            'label' => 'lang:admin::lang.button_new',
            'class' => 'btn btn-primary',
            'href' => 'igniter/frontend/banners/create',
        ],
        'delete' => [
            'label' => 'lang:admin::lang.button_delete',
            'class' => 'btn btn-danger',
            'data-request-form' => '#list-form',
            'data-request-handler' => 'onDelete',
            'data-request-confirm' => 'lang:admin::lang.alert_warning_confirm',
        ],
        'filter' => [
            'label' => 'lang:admin::lang.button_icon_filter',
            'class' => 'btn btn-default btn-filter',
            'data-toggle' => 'list-filter',
            'data-target' => '.list-filter',
        ],
    ],
];

$config['list']['columns'] = [
    'edit' => [
        'type' => 'button',
        'iconCssClass' => 'fa fa-pencil',
        'attributes' => [
            'class' => 'btn btn-edit',
            'href' => 'igniter/frontend/banners/edit/{banner_id}',
        ],
    ],
    'name' => [
        'label' => 'lang:igniter.frontend::default.banners.column_name',
        'type' => 'text',
        'searchable' => TRUE,
    ],
    'type_label' => [
        'label' => 'lang:igniter.frontend::default.banners.column_type',
        'type' => 'text',
    ],
    'status' => [
        'label' => 'lang:igniter.frontend::default.banners.column_status',
        'type' => 'switch',
        'searchable' => TRUE,
    ],
    'banner_id' => [
        'label' => 'lang:admin::lang.column_id',
        'invisible' => TRUE,
    ],

];

$config['form']['toolbar'] = [
    'buttons' => [
        'save' => [
            'label' => 'lang:admin::lang.button_save',
            'context' => ['create', 'edit'],
            'class' => 'btn btn-primary',
            'data-request' => 'onSave',
            'data-request-submit' => 'true',
        ],
        'saveClose' => [
            'label' => 'lang:admin::lang.button_save_close',
            'context' => ['create', 'edit'],
            'class' => 'btn btn-default',
            'data-request' => 'onSave',
            'data-request-submit' => 'true',
            'data-request-data' => 'close:1',
        ],
        'delete' => [
            'label' => 'lang:admin::lang.button_icon_delete',
            'context' => ['edit'],
            'class' => 'btn btn-danger',
            'data-request' => 'onDelete',
            'data-request-submit' => 'true',
            'data-request-confirm' => 'lang:admin::lang.alert_warning_confirm',
        ],
    ],
];

$config['form']['fields'] = [
    'name' => [
        'label' => 'lang:igniter.frontend::default.banners.label_name',
        'type' => 'text',
    ],
    'type' => [
        'label' => 'lang:igniter.frontend::default.banners.label_type',
        'type' => 'radio',
        'default' => 'image',
        'options' => [
            'image' => 'lang:igniter.frontend::default.banners.text_image',
            'custom' => 'lang:igniter.frontend::default.banners.text_custom',
        ],
    ],
    'image_code' => [
        'label' => 'lang:igniter.frontend::default.banners.label_image',
        'type' => 'mediafinder',
        'mode' => 'grid',
        'commentAbove' => 'lang:igniter.frontend::default.banners.help_image',
        'isMulti' => TRUE,
        'trigger' => [
            'action' => 'hide',
            'field' => 'type',
            'condition' => 'value[custom]',
        ],
    ],
    'custom_code' => [
        'label' => 'lang:igniter.frontend::default.banners.label_custom_code',
        'type' => 'textarea',
        'trigger' => [
            'action' => 'show',
            'field' => 'type',
            'condition' => 'value[custom]',
        ],
    ],
    'alt_text' => [
        'label' => 'lang:igniter.frontend::default.banners.label_alt_text',
        'type' => 'text',
    ],
    'click_url' => [
        'label' => 'lang:igniter.frontend::default.banners.label_click_url',
        'type' => 'text',
        'comment' => 'lang:igniter.frontend::default.banners.help_click_url',
    ],
    'language_id' => [
        'label' => 'lang:igniter.frontend::default.banners.label_language',
        'type' => 'relation',
        'relationFrom' => 'language',
        'placeholder' => 'lang:admin::lang.text_please_select',
    ],
    'status' => [
        'label' => 'lang:admin::lang.label_status',
        'type' => 'switch',
        'default' => TRUE,
    ],
];

return $config;