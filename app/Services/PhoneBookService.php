<?php

namespace App\Services;

use App\Models\Persons;
use App\Models\Contacts;

/**
 * Description of PhoneBookService
 */
class PhoneBookService
{
    /**/
    public function registerPerson(array $requestData, string $filePath = null)
    {
        $retVal = null;

        $person = new Persons();
        $person->name = $requestData['name'];
        $person->photo = $filePath;
        $person->address = $requestData['address'];
        $person->mail_address = $requestData['mailAddress'];

        $person->save();

        $person_id = $person->id;

        if (!empty($person_id))
        {
            $contact = new Contacts();
            $contact->user_id = $person_id;
            $contact->phone = $requestData['mphone'];
            $contact->email = $requestData['email'];

            $contact->save();

            $retVal = $contact->id;
        }

        return $retVal;
    }

    /**/
    public function checkPersonExistance(string $name): array
    {
        $persons = new Persons();
        $checkResult = $persons->where('name', $name)
                ->get();
        return $checkResult->toArray();
    }

    public function updatePerson(array $requestData, string $userId)
    {

    }

    /**/
    public function getPerson(){}

    /**/
    public function getPersons()
    {
        $persons = new Persons();
        return $persons->get()->toArray();
    }
}
