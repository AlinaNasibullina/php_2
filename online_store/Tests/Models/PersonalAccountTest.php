<?php

namespace Models;

use BaseTest;
use MyApp\Models\PersonalAccount;

class PersonalAccountTest extends BaseTest
{
    /**
     * 
     * @dataProvider checkUserProvider
     * @param $expected
     * @param $user
     */
    public function testCheckUser($expected, $user)
    {
        print_r(PersonalAccount::checkUser($user['name'], $user['pass']));
        self::assertEquals($expected, PersonalAccount::checkUser($user['name'], $user['pass']));
    }

    public function checkUserProvider()
    {
        return [
            [true, ['name' => 'admin', 'pass' => '123456']],
            [false, ['name' => 'admin', 'pass' => '1234']],
            [false, ['name' => 'abcd', 'pass' => '123456']],
            [false, ['name' => '', 'pass' => '']],
            [false, ['name' => 'admin', 'pass' => '']],
            [false, ['name' => '', 'pass' => '123456']],
        ];
    }

    /**
     * @dataProvider getUserProvider
     * @param $expected
     * @param $user_name
     */
    public function testGetUser($expected, $user_name)
    {
        self::assertEquals($expected, PersonalAccount::getUser($user_name));
    }

    public function getUserProvider()
    {
        return [
            [false, ''],
            [
                [
                    'id' => '1',
                    'role_id' => '1',
                    'user_name' => 'admin',
                    'password_hash' => '$2y$10$L5bdhIerwHAmzqn9j/QjHunfkMqno3.o/mqxEKdf8NILQtFUGVKvW',
                    'user_full_name' => null,
                ],
                'admin'
            ],
            [false, 'abcd'],
        ];
    }

}