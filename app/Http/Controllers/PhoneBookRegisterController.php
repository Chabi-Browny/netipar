<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Prototype\AbstractController;
use App\Handler\FileStorageHandler;
use App\Services\PhoneBookService;

use Illuminate\Support\Facades\Validator;

class PhoneBookRegisterController extends AbstractController
{
    /**/
    public function init()
    {
        $this->setViewName('pages/register');
        $this->setViewData('title', 'Phonebook Register');
    }

    /**
     * @desc - Create or Update a new person through the registration process
     */
    public function register()
    {
        $retVal = null;
        $fileHandler = null;
        $addedFile = null;

        $requests = $this->request->all();

        $inputRules = [
            'name' => 'alpha',
            'email' => 'required|email|unique:contacts,email',
            'photo' => 'file|max:1024|mimes:jpg,bmp,png',
        ];

        $mailAddress = $this->request->post('mailAddress');
        $mailAddressRules = 'alpha_num';

        if (array_key_exists('sameAddress', $requests))// if the checkbox selected
        {
            $mailAddress = $this->request->post('address'); // it's good to be the frontend work !!!!

            $mailAddressRules .= '|same:address';
        }

        if (isset($requests['mphone']))
        {
            $inputRules['mphone'] = 'unique:contacts,phone|max:10';
        }

        if (isset($requests['address']))
        {
            $inputRules['address'] = 'alpha_num';

            if ($mailAddress !== null)
            {
                $inputRules['mailAddress'] = $mailAddressRules;
            }
        }

        $messages = [
            'mailAddress.same' => 'The :other and :attribute must match !'
        ];

        $validate = Validator::make($requests, $inputRules, $messages);
        // if not valid it will redirect, else move forward
        $validate->validate();

        // if has photo in the request setup the file handler
        if ($this->request->file('photo') !== null) {
            $fileHandler = new FileStorageHandler($this->request->file('photo'));
        }

        $phoneBookeServ = new PhoneBookService();

        // check if exist the current user
        $personCheckResult = $phoneBookeServ->checkPersonExistance( $this->request->post('name') );
dump($personCheckResult);

        if ( $personCheckResult === null)
        {
            $addedFile = $fileHandler !== null ? $fileHandler->addFile() : null;
            ///add new user
            $retVal = $phoneBookeServ->registerPerson($requests, $addedFile);
        }
        else
        {
            if ($fileHandler !== null)
            {
                $photo = $personCheckResult['photo'] !== null ? $personCheckResult['photo'] : $fileHandler->addFile();

                // and if has, then delete it (but it could be warn the user if it has another photo currently, so he/she need to be prove it the acceptance to do it)
                // and then upload
                $addedFile = $fileHandler->changeFile($photo);
                // and after than update the db too
            }
            $phoneBookeServ->updatePerson($requests, $personCheckResult['person'], $addedFile);
        }

        return redirect('register')->with('regSucc', 'Registration success!');///////////////////////////////////////////////////////WIP
    }

}