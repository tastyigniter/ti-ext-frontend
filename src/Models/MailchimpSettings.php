<?php

namespace Igniter\Frontend\Models;

use Igniter\Flame\Database\Model;

class MailchimpSettings extends Model
{
    public array $implement = [\Igniter\System\Actions\SettingsModel::class];

    public string $settingsCode = 'igniter_frontend_mailchimpsettings';

    public string $settingsFieldsConfig = 'mailchimpsettings';

    public static function isConfigured()
    {
        return strlen(self::get('api_key', '')) && strlen(self::get('list_id', ''));
    }
}
