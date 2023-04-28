<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Prototype\AbstractController;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Http\Request;

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
        $requests = $this->request->all();

        $mailAddressRules = 'alpha_num';

        $mailAddress = $this->request->post('mailAddress');

        if (array_key_exists('sameAddress', $requests))
        {
            $mailAddress = $this->request->post('address'); // it's good to be the frontend work
            $mailAddressRules .= '|same:address';
        }

        $inputRules = [
            'name' => 'alpha',
            'email' => 'required|email|unique:contacts,email',
            'photo' => 'file|max:1024|mimes:jpg,bmp,png',//checking mime 246264
            'mphone' => 'required|unique:contacts,phone',
            'address' => 'alpha_num',
            'mailAddress' => $mailAddressRules///////(Amennyiben ugyan az, akkor csak 1x kelljen kitölteni) |same:address
        ];

        $messages = [
            'mailAddress.same' => 'The :other and :attribute must match !' ///A(z) :attribute és :other mezőknek egyezniük kell!
        ];

        $validate = Validator::make($requests, $inputRules, $messages);

        // if not valid it will redirect, else ...
        $validate->validate();

        


dd('STOP AT:' . __METHOD__);
    }
}
