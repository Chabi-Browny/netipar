<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Prototype\AbstractController;

class PhoneBookController extends AbstractController
{
    public function init()
    {
        $this->setViewName('pages/phonebookList');
        $this->setViewData('title', 'Phonebook List');
    }

    /**/
    public function list()
    {

    }

}
