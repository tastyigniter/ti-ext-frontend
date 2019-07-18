<?php

namespace Igniter\Frontend\Models;

use Model;

class MailchimpSettings extends Model
{
    public $implement = ['System\Actions\SettingsModel'];

    public $settingsCode = 'igniter_frontend_mailchimpsettings';

    public $settingsFieldsConfig = 'mailchimpsettings';
}