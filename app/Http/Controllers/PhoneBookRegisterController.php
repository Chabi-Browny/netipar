<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Prototype\AbstractController;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Http\Request;

use App\Handler\FileStorageHandler;
use App\Services\PhoneBookService;

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
        $retVal = null;
        $fileHandler = null;
        $addedFile = null;

        $requests = $this->request->all();

        $mailAddress = $this->request->post('mailAddress');
        $mailAddressRules = 'alpha_num';

        if (array_key_exists('sameAddress', $requests))
        {
            $mailAddress = $this->request->post('address'); // it's good to be the frontend work !!!!
            $mailAddressRules .= '|same:address';
        }

        $inputRules = [
            'name' => 'alpha',
            'email' => 'required|email|unique:contacts,email',
            'photo' => 'file|max:1024|mimes:jpg,bmp,png',//checking mime 246264
            'mphone' => 'unique:contacts,phone|max:16',
            'address' => 'alpha_num',
            'mailAddress' => $mailAddressRules///////(Amennyiben ugyan az, akkor csak 1x kelljen kitölteni) |same:address
        ];

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
//dump($fileHandler);

        $phoneBookeServ = new PhoneBookService();

        // check if exist the current user
        $personCheckResult = $phoneBookeServ->checkPersonExistance( $this->request->post('name') );
dump($personCheckResult[0]);

        if ( $personCheckResult === [])
        {
            $addedFile = $fileHandler !== null ? $fileHandler->addFile() : null;
            ///add new user
            $retVal = $phoneBookeServ->registerPerson($requests, $addedFile);
        }
        else
        {
            if ($fileHandler !== null)
            {
                $addedFile = $fileHandler->changeFile($personCheckResult[0]['photo']);

            dump($addedFile);
            dd('szivacs');

                ///then check if has an uploaded file, indicates from the db photo namePath
                /// and if has, then delete it (but it could be warn the user if it has another photo currently, so he/she need to be prove it the acceptance to do it)
                /// and then upload and update the db too
            }

            $phoneBookeServ->updatePerson($requests, $personCheckResult[0]['id'], $addedFile);
        ///and if so, than update the profile if have new stuff
            ///update old users
        }

//        dump($file->storeAs($mailAddressRules, $name, $messages));
dump($retVal);
dd('STOP AT:' . __METHOD__);

    }

    /**/
    public function list()
    {

    }

}
