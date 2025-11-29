<?php
namespace App\PageType;

use PageController;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;

class UserController extends PageController // Atau nama controller Anda
{
    /**
     * Mengembalikan daftar pengguna dalam format ArrayList untuk digunakan di template.
     *
     * @return ArrayList
     */
    public function getUsersList()
    {
        // Data array PHP mentah Anda
        $usersArray = [
            [
                'FirstName' => 'John',
                'LastName' => 'Doe',
                'Email' => 'john.doe@example.com'
            ],
            [
                'FirstName' => 'Jane',
                'LastName' => 'Smith',
                'Email' => 'jane.smith@example.com'
            ],
            [
                'FirstName' => 'Peter',
                'LastName' => 'Jones',
                'Email' => 'peter.jones@example.com'
            ]
        ];

        // Bungkus data ke dalam ArrayList yang berisi ArrayData
        $userList = ArrayList::create();
        foreach ($usersArray as $userData) {
            $userList->push(ArrayData::create($userData));
        }

        return $userList;
    }
}
?>