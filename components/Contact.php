<?php

namespace SamPoyigi\FrontEnd\Components;

use Location;
use System\Classes\BaseComponent;

class Contact extends BaseComponent
{
    public $location;

    public $subjects;

    public function onRun()
    {
        $this->location = Location::current();

        $this->subjects = ['General enquiry', 'Comment', 'Technical Issues'];
    }

    public function renderCaptcha()
    {

    }

    public function onSubmit()
    {

    }
}