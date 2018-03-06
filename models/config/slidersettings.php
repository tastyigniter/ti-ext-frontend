<?php

return [
    'form' => [
        'toolbar' => [
            'buttons' => [
                'save'      => ['label' => 'lang:admin::default.button_save', 'class' => 'btn btn-primary', 'data-request' => 'onSave'],
                'saveClose' => [
                    'label'             => 'lang:admin::default.button_save_close',
                    'class'             => 'btn btn-default',
                    'data-request'      => 'onSave',
                    'data-request-data' => 'close:1',
                ],
                'back'      => ['label' => 'lang:admin::default.button_icon_back', 'class' => 'btn btn-default', 'href' => 'settings'],
            ],
        ],
        'fields'  => [
            'display'     => [
                'label'   => 'lang:sampoyigi.frontend::default.slider.label_display',
                'span'    => 'left',
                'type'    => 'radio',
                'default' => '1',
                'options' => [
                    'lang:admin::default.text_hide',
                    'lang:admin::default.text_show',
                ],
            ],
            'dimension_h' => [
                'label'   => 'lang:sampoyigi.frontend::default.slider.label_dimension_h',
                'span'    => 'right',
                'type'    => 'number',
                'default' => 360,
            ],
            'dimension_w' => [
                'label'   => 'lang:sampoyigi.frontend::default.slider.label_dimension_w',
                'span'    => 'left',
                'type'    => 'number',
                'default' => 960,
            ],
            'effect'      => [
                'label'   => 'lang:sampoyigi.frontend::default.slider.label_effect',
                'span'    => 'right',
                'type'    => 'text',
                'default' => 'ease',
            ],
            'speed'       => [
                'label'   => 'lang:sampoyigi.frontend::default.slider.label_speed',
                'span'    => 'left',
                'type'    => 'number',
                'default' => 500,
            ],
            'images'      => [
                'label'   => 'lang:sampoyigi.frontend::default.slider.label_slide_image',
                'type'    => 'mediafinder',
                'isMulti' => TRUE,
            ],
        ],
        'rules'   => [
            ['dimension_h', 'lang:sampoyigi.frontend::default.slider.label_dimension_h', 'required|integer'],
            ['dimension_w', 'lang:sampoyigi.frontend::default.slider.label_dimension_w', 'required|integer'],
            ['effect', 'lang:sampoyigi.frontend::default.slider.label_effect', 'required'],
            ['speed', 'lang:sampoyigi.frontend::default.slider.label_speed', 'integer'],
            ['display', 'lang:sampoyigi.frontend::default.slider.label_display', 'required|integer'],
            ['images[]', 'lang:sampoyigi.frontend::default.slider.label_slide_image'],
        ],
    ],
];