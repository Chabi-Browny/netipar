<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Prototype\AbstractController;

class PhoneBookRegisterController extends AbstractController
{
    /**/
    public function init()
    {
        $this->setViewName('pages/register');
        $this->setViewData('title', 'Phonebook Register');
    }
    
    /**/
    public function register()
    {
        
    }
}
