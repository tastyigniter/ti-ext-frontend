<?php namespace SamPoyigi\FrontEnd\Components;

use Admin\Models\Banners_model;
use Admin\Models\Image_tool_model;

class Banners extends \System\Classes\BaseComponent
{
    public $banner;

    public function defineProperties()
    {
        return [
            'banner_id' => [
                'label' => 'lang:column_banner',
                'type'  => 'select',
            ],
            'width'     => [
                'label'   => 'lang:label_width',
                'span'    => 'left',
                'type'    => 'number',
                'default' => 960,
            ],
            'height'    => [
                'label'   => 'lang:label_height',
                'span'    => 'right',
                'type'    => 'text',
                'default' => 360,
            ],
        ];
    }

    public static function getBannerIdOptions()
    {
        return Banners_model::isEnabled()->dropdown('name');
    }

    public function onRun()
    {
        $this->page['banner'] = $this->loadBanner();
    }

    protected function loadBanner()
    {
        if (isset($this->banner))
            return $this->banner;

        $model = Banners_model::isEnabled()
                              ->where('banner_id', $this->property('banner_id'))->first();

        $banner = new \stdClass;
        $banner->id = 'banner-slideshow-'.uniqid();
        $banner->type = $model->type;
        $banner->isCustom = ($model->type == 'custom');
        $banner->clickUrl = site_url($model->click_url);
        $banner->altText = $model->alt_text;
        $banner->value = $this->prepareImages($model);

        return $this->banner = $banner;
    }

    protected function prepareImages(Banners_model $banner)
    {
        if ($banner->type == 'custom')
            return $banner->custom_code;

        $images = array_filter($banner->image_code);

        return array_map(function ($path) {
            $imageHeight = $this->property('width');
            $imageWidth = $this->property('height');

            return [
                'name'   => basename($path),
                'height' => $imageHeight,
                'width'  => $imageWidth,
                'url'    => Image_tool_model::resize($path, [
                    'width'  => $imageWidth,
                    'height' => $imageHeight,
                ]),
            ];
        }, (array)$images);
    }
}