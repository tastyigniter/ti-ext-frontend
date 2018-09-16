<?php

return [
    'form' => [
        'toolbar' => [
            'buttons' => [
                'save' => ['label' => 'lang:admin::lang.button_save', 'class' => 'btn btn-primary', 'data-request' => 'onSave'],
                'saveClose' => [
                    'label' => 'lang:admin::lang.button_save_close',
                    'class' => 'btn btn-default',
                    'data-request' => 'onSave',
                    'data-request-data' => 'close:1',
                ],
            ],
        ],
        'fields' => [
            'display' => [
                'label' => 'lang:igniter.frontend::default.slider.label_display',
                'span' => 'left',
                'type' => 'radio',
                'default' => '1',
                'options' => [
                    'lang:admin::lang.text_hide',
                    'lang:admin::lang.text_show',
                ],
            ],
            'dimension_h' => [
                'label' => 'lang:igniter.frontend::default.slider.label_dimension_h',
                'span' => 'right',
                'type' => 'number',
                'default' => 360,
            ],
            'dimension_w' => [
                'label' => 'lang:igniter.frontend::default.slider.label_dimension_w',
                'span' => 'left',
                'type' => 'number',
                'default' => 960,
            ],
            'effect' => [
                'label' => 'lang:igniter.frontend::default.slider.label_effect',
                'span' => 'right',
                'type' => 'text',
                'default' => 'ease',
            ],
            'speed' => [
                'label' => 'lang:igniter.frontend::default.slider.label_speed',
                'span' => 'left',
                'type' => 'number',
                'default' => 500,
            ],
            'images' => [
                'label' => 'lang:igniter.frontend::default.slider.label_slide_image',
                'type' => 'mediafinder',
                'isMulti' => TRUE,
            ],
        ],
        'rules' => [
            ['dimension_h', 'lang:igniter.frontend::default.slider.label_dimension_h', 'required|integer'],
            ['dimension_w', 'lang:igniter.frontend::default.slider.label_dimension_w', 'required|integer'],
            ['effect', 'lang:igniter.frontend::default.slider.label_effect', 'required'],
            ['speed', 'lang:igniter.frontend::default.slider.label_speed', 'integer'],
            ['display', 'lang:igniter.frontend::default.slider.label_display', 'required|integer'],
            ['images.*', 'lang:igniter.frontend::default.slider.label_slide_image'],
        ],
    ],
];