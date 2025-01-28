<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Prototype\AbstractController;
use App\Services\PhoneBookService;

class PhoneBookController extends AbstractController
{
    public function init()
    {
        $this->setViewName('pages/list');
        $this->setViewData( 'title', 'Phonebook List' );
        $this->setViewData( 'list', $this->list() );
    }

    /**/
    protected function list()
    {
        return (new PhoneBookService())->getPersons();
    }

}
