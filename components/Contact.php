<?php

namespace Igniter\Frontend\Components;

use Admin\Traits\ValidatesForm;
use Exception;
use Location;
use Mail;
use Main\Template\Page;
use Redirect;
use System\Classes\BaseComponent;

class Contact extends BaseComponent
{
    use ValidatesForm;

    public $location;

    public $subjects;

    public function defineProperties()
    {
        return [
            'redirectPage' => [
                'label' => 'Page to redirect to after contact form has been sent successfully',
                'type' => 'select',
                'default' => 'contact',
            ],
        ];
    }

    public static function getRedirectPageOptions()
    {
        return Page::lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $this->location = Location::current();

        $this->subjects = ['General enquiry', 'Comment', 'Technical Issues'];
    }

    public function onSubmit()
    {
        try {
            $rules = [
                ['subject', 'lang:igniter.frontend::default.contact.text_select_subject', 'required|max:128'],
                ['email', 'lang:igniter.frontend::default.contact.label_email', 'required|email'],
                ['full_name', 'lang:igniter.frontend::default.contact.label_full_name', 'required|min:6|max:255'],
                ['telephone', 'lang:igniter.frontend::default.contact.label_telephone', 'required'],
                ['comment', 'lang:igniter.frontend::default.contact.label_comment', 'max:1500'],
            ];

            $this->validate(post(), $rules);

            $data = [
                'full_name' => post('full_name'),
                'contact_topic' => post('subject'),
                'contact_telephone' => post('telephone'),
                'contact_message' => post('comment'),
            ];

            Mail::send('igniter.frontend::mail.contact', $data, function ($message) {
                $message->to(setting('site_email'), setting('site_name'));
            });

            flash()->success(lang('igniter.frontend::default.contact.alert_contact_sent'));

            $redirectUrl = $this->controller->pageUrl($this->property('redirectPage'));

            if ($redirectUrl = get('redirect', $redirectUrl))
                return Redirect::to($redirectUrl);
        }
        catch (Exception $ex) {
            flash()->warning($ex->getMessage());

            return Redirect::back()->withInput();
        }
    }
}