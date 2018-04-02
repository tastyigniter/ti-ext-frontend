<?php namespace SamPoyigi\FrontEnd\Components;

use Main\Models\Image_tool_model;
use SamPoyigi\FrontEnd\Models\SliderSettings;

class Slider extends \System\Classes\BaseComponent
{
    public function onRun()
    {
        $this->addCss('vendor/flexslider/flexslider.css', 'flexslider-css');
        $this->addCss('css/slider.css', 'slider-css');
        $this->addJs('vendor/flexslider/jquery.flexslider.js', 'flexslider-js');
        $this->addJs('js/slider.js', 'slider-js');

        $this->page['sliderId'] = 'slideshow-'.uniqid();
        $this->page['sliderHeight'] = SliderSettings::get('dimension_h', '360');
        $this->page['sliderWidth'] = SliderSettings::get('dimension_w', '960');
        $this->page['sliderEffect'] = SliderSettings::get('effect', 'ease');
        $this->page['sliderSpeed'] = SliderSettings::get('speed', '500');
        $this->page['displaySlides'] = SliderSettings::get('display', '1');

        $this->page['slidesImages'] = $this->loadSlides();
    }

    protected function loadSlides()
    {
        $result = [];
        $slides = SliderSettings::get('images', []);
        if (empty($slides)) {
            return $result;
        }

        foreach ($slides as $slide) {
            $image_src = 'data/no_photo.png';
            if (is_string($slide))
                $image_src = $slide;

            $image_src = (isset($slide['image_src'])) ? $slide['image_src'] : $image_src;
            $caption = (isset($slide['caption'])) ? $slide['caption'] : '';

            $slider = [
                'height'  => $this->page['sliderHeight'],
                'width'   => $this->page['sliderWidth'],
                'caption' => $caption,
            ];

            $slider['image_src'] = Image_tool_model::resize($image_src, $slider);

            $result[] = $slider;
        }

        return $result;
    }
}
