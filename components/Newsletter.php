<?php namespace SamPoyigi\FrontEnd\Components;

use Admin\Traits\ValidatesForm;
use SamPoyigi\Featured_menus\Models\Subscriber;

class Newsletter extends \System\Classes\BaseComponent
{
    use ValidatesForm;

    public function onRun()
    {
        $this->page['subscribeHandler'] = $this->getEventHandler('onSubscribe');
    }

    public function onSubscribe()
    {
        $data = post();

        $rules = [
            ['email', 'lang:sampoyigi.frontend::default.newsletter.label_email', 'required|email8'],
        ];

        $this->validate($data, $rules);

        if (Subscriber::whereEmail($data['email'])->first()) {
            flash()->success(lang('sampoyigi.frontend::default.newsletter.alert_success_existing'))->now();
        }
        else {
            Subscriber::create($data);
            flash()->success(lang('sampoyigi.frontend::default.newsletter.alert_success_subscribed'))->now();
        }

        $this->pageCycle();

        return [
            '^#newsletter-box' => $this->renderPartial('@default'),
        ];
    }
}
