<?php namespace SamPoyigi\FrontEnd\Components;

class Newsletter extends \System\Classes\BaseComponent
{
    public function onRun()
    {
        $this->page['subscribeHandler'] = $this->getEventHandler('onSubscribe');
        $this->page['subscribeCssClass'] = 'col-sm-6 center-block';
    }

    public function onSubscribe()
    {

        dd($this->input->post('subscribe_email'));
        $this->lang->load('newsletter/newsletter');

        $this->load->library('user_agent');
        $validated = FALSE;
        $json = [];

        $referrer_uri = explode('/', str_replace(site_url(), '', $this->agent->referrer()));
        $referrer_uri = (!empty($referrer_uri[0]) AND $referrer_uri[0] !== 'newsletter') ? $referrer_uri[0] : 'home';

        $this->form_validation->set_rules('subscribe_email', 'lang:label_email', 'required|valid_email');

        if ($this->form_validation->run() === TRUE) {                                            // checks if form validation routines ran successfully
            $validated = TRUE;
        }
        else {
            $json['error'] = $this->form_validation->error('subscribe_email', '', '');
        }

        if ($validated === TRUE) {
            $settings = $this->Extensions_model->getSettings('newsletter');

            is_array($settings['subscribe_list']) OR $settings['subscribe_list'] = [];

            $subscribe_email = strtolower($this->input->post('subscribe_email'));

            if (!in_array($subscribe_email, $settings['subscribe_list'])) {
                $settings['subscribe_list'][] = $subscribe_email;

                if ($this->Extensions_model->saveExtensionData('newsletter', $settings)) {
                    $json['success'] = lang('alert_success_subscribed');
                }
            }
            else if (in_array($subscribe_email, $settings['subscribe_list'])) {

                $json['success'] = lang('alert_success_existing');
            }
            else {
                $json['error'] = lang('alert_error_try_again');
            }
        }

        $redirect = $referrer_uri;

        if ($this->input->is_ajax_request()) {
            $this->output->set_output(json_encode($json));                                            // encode the json array and set final out to be sent to jQuery AJAX
        }
        else {
            if (isset($json['error'])) $this->alert->set('danger', $json['error'], 'newsletter_alert');
            if (isset($json['success'])) $this->alert->set('success', $json['success'], 'newsletter_alert');
            $this->redirect($redirect);
        }
    }
}
