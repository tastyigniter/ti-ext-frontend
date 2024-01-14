<?php

namespace Igniter\Frontend\Models;

use Igniter\Flame\Database\Model;

class CaptchaSettings extends Model
{
    public array $implement = [\Igniter\System\Actions\SettingsModel::class];

    // A unique code
    public string $settingsCode = 'igniter_frontend_captchasettings';

    // Reference to field configuration
    public string $settingsFieldsConfig = 'captchasettings';
}
