<?php

namespace Igniter\Frontend\Models;

use DrewM\MailChimp\MailChimp;
use Igniter\Flame\Database\Model;
use Igniter\Flame\Exception\ApplicationException;

class Subscriber extends Model
{
    protected $table = 'igniter_frontend_subscribers';

    protected $primaryKey = 'id';

    protected $fillable = ['email'];

    public function subscribeToMailchimp(string $listId = null, array $options = [])
    {
        throw_unless(MailChimpSettings::isConfigured(), new ApplicationException(
            'MailChimp List ID is missing. Enter your mailchimp api key and list ID from the admin settings page'
        ));

        $listId = (string)MailChimpSettings::get('list_id');

        $response = resolve(MailChimp::class)->post("lists/$listId/members", array_merge([
            'email_address' => $this->email,
            'status' => 'subscribed',
            'email_type' => 'html',
        ], $options));

        $errorMessage = array_get($response, 'detail', '');

        throw_if(strlen($errorMessage) && array_get($response, 'status') !== 200, new ApplicationException($errorMessage));
    }
}
