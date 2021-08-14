<?php


namespace CodelyTV\FinderKata\Domain\User\Factory;


use CodelyTV\FinderKata\Domain\User\Model\User;
use DateTime;

class UserFactory
{
    public function createUser(string $name, DateTime $birthdate): User
    {
        $user = new User;
        $user->setName($name);
        $user->setBirthDate($birthdate);
        return $user;
    }

}