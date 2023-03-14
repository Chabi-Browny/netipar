<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Prototype\AbstractController;

/**
 * Description of HomeController
 *
 * @author Csaba Baranbas Barcsa
 */
class HomeController extends AbstractController
{    
    public function init()
    {
        $this->setViewName('pages/welcome');
        $this->setViewData('title', 'Welcome!');
    }
}