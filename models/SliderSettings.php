<?php

namespace SamPoyigi\FrontEnd\Models;

use Model;

class SliderSettings extends Model
{
    public $implement = ['System\Actions\SettingsModel'];

    // A unique code
    public $settingsCode = 'sampoyigi_frontend_slidersettings';

    // Reference to field configuration
    public $settingsFieldsConfig = 'slidersettings';

    public function getImagesAttribute($value)
    {
        if (!isset($this->attributes['slides']))
            return [];

        if (isset($this->attributes['images']))
            return $this->attributes['images'];

        $result = [];
        foreach ($this->attributes['slides'] as $slide) {
            $result[] = $slide['image_src'];
        }

        return $result;
    }
}
