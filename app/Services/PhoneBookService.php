<?php

namespace App\Services;

use App\Models\Persons;
use App\Models\Contacts;

use Illuminate\Database\Eloquent\Collection;
/**
 * Description of PhoneBookService
 */
class PhoneBookService
{
    /**
     * @desc - register a person
     * @param array $requestData
     * @param string $filePath
     * @return null|int
     */
    public function registerPerson(array $requestData, string $filePath = null): ?int
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
            $contact->persons_id = $person_id;
            $contact->phone = $requestData['mphone'];
            $contact->email = $requestData['email'];

            $contact->save();

            $retVal = $contact->id;
        }

        return $retVal;
    }

    /**
     * @desc - Check person if exist in the database, and returns it with some data
     * @param string $name
     * @return array|null
     */
    public function checkPersonExistance(string $name): ?array
    {
        $retVal = null;
        $checkResult = $this->getPerson($name);
        $resultArray = $checkResult->toArray();

        if ($resultArray !== [])
        {
            $retVal = [
                'person' => $checkResult->first(), // Persons::class
                'personId' => $resultArray[0]['id'],
                'photo' => $resultArray[0]['photo']
            ];
        }

        return $retVal;
    }

    /**
     * @desc - Update a person
     * @param array $requestData
     * @param Persons $person
     * @param string $filePath
     */
    public function updatePerson(array $requestData, Persons $person, string $filePath = null): void
    {
        $hasRequestedEmail = false;
        $hasRequestedPhone = false;

        // if has requested photo it will updated too
        if ($filePath !== null)
        {
            $person->photo = $filePath;
        }
        $person->address = $requestData['address'];
        $person->mail_address = $requestData['mailAddress'];
        // update the person
        $person->save();

        $person_id = $person->id;

        if (!empty($person_id))
        {
            $oldContacts = $person->contacts->toArray();

            // checking contacts if some mach with the requested one
            foreach ($oldContacts as $oldContact)
            {
                if ($oldContact['email'] === $requestData['email'])
                {
                    $hasRequestedEmail = true;
                }
                else if (($oldContact['email'] === $requestData['email']) && ($requestData['phone'] === null))
                {
                    continue;
                }

                if ($oldContact['phone'] === $requestData['mphone'])
                {
                    $hasRequestedPhone = true;
                }
            }

            $contact = new Contacts();
            $contact->persons_id = $person_id;

            if (!$hasRequestedEmail)
            {
                $contact->email = $requestData['email'];
            }

            if (!$hasRequestedPhone)
            {
                $contact->phone = array_key_exists('mphone', $requestData) ? $requestData['mphone'] : null;
            }

            // save the new contact
            $contact->save();
        }
    }

    /**/
    public function getPerson(string $name): Collection
    {
        $persons = new Persons();
        /** @var Collection $checkResult */
        return $persons->where('name', $name)->get();
    }

    /**/
    public function getPersons(): array
    {
        $retVal = [];
        $persons = new Persons();

        if ($persons !== null)
        {
            // persons with thier contacts !  :) S.D.G. && P.G.A.! :)
            $retVal = $persons::with('contacts')
                ->select('persons.id', 'persons.name', 'persons.address', 'persons.mail_address', 'persons.photo')
                ->get()
                ->toArray();
        }

        return $retVal;
    }

}
