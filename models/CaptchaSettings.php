<?php

namespace Igniter\Frontend\Models;

use Model;

class CaptchaSettings extends Model
{
    public $implement = ['System\Actions\SettingsModel'];

    // A unique code
    public $settingsCode = 'igniter_frontend_captchasettings';

    // Reference to field configuration
    public $settingsFieldsConfig = 'captchasettings';
}
