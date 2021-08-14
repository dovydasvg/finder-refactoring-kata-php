<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

use InvalidArgumentException;

class UserBirthdateDifferenceValueObject
{
    private $userBornLater;
    private $userBornEarlier;
    private $birthdateDifference;

    public function __construct(User $userBornLater=null, User $userBornEarlier=null, int $birthdateDifference=null)
    {
        $this->userBornEarlier = $userBornEarlier;
        $this->userBornLater = $userBornLater;
        $this->birthdateDifference = $birthdateDifference;
    }

    /**
     * @return int|null
     */
    public function getBirthdateDifference()
    {
        return $this->birthdateDifference;
    }

    /**
     * @param mixed $birthdateDifference
     */
    public function setBirthdateDifference(int $birthdateDifference)
    {
        if($birthdateDifference < 0){
            throw new InvalidArgumentException("Birthdate Difference must be a positive integer.");
        }
        $this->birthdateDifference = $birthdateDifference;
    }

    /**
     * @return User|null
     */
    public function getUserBornLater()
    {
        return $this->userBornLater;
    }

    /**
     * @param User|null $userBornLater
     */
    public function setUserBornLater(User $userBornLater)
    {
        $this->userBornLater = $userBornLater;
    }

    /**
     * @return User|null
     */
    public function getUserBornEarlier()
    {
        return $this->userBornEarlier;
    }

    /**
     * @param User|null $userBornEarlier
     */
    public function setUserBornEarlier(User $userBornEarlier)
    {
        $this->userBornEarlier = $userBornEarlier;
    }


}
