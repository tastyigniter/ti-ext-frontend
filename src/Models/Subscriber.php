<?php

namespace Igniter\Frontend\Models;

use DrewM\MailChimp\MailChimp;
use Igniter\Flame\Database\Model;
use Igniter\Flame\Exception\ApplicationException;
use Illuminate\Support\Facades\Event;

class Subscriber extends Model
{
    protected $table = 'igniter_frontend_subscribers';

    protected $primaryKey = 'id';

    protected $fillable = ['email'];

    public static function subscribe(string $email, ?string $listId = null): static
    {
        $data = ['email' => $email];

        $subscribe = self::firstOrCreate($data);

        if ($listId && MailchimpSettings::isConfigured()) {
            $subscribe->subscribeToMailchimp($listId);
        }

        Event::dispatch('igniter.frontend.subscribed', [$subscribe, $data]);

        return $subscribe;
    }

    public function subscribeToMailchimp(?string $listId = null, array $options = [])
    {
        throw_unless(MailchimpSettings::isConfigured(), new ApplicationException(
            'MailChimp List ID is missing. Enter your mailchimp api key and list ID from the admin settings page'
        ));

        $listId = (string)MailchimpSettings::get('list_id');

        $response = resolve(MailChimp::class)->post("lists/$listId/members", array_merge([
            'email_address' => $this->email,
            'status' => 'subscribed',
            'email_type' => 'html',
        ], $options));

        $errorMessage = array_get($response, 'detail', '');

        throw_if(strlen($errorMessage) && array_get($response, 'status') !== 200, new ApplicationException($errorMessage));

        return $response;
    }
}
