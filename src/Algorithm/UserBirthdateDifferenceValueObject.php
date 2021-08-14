<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

use InvalidArgumentException;

class UserBirthdateDifferenceValueObject
{
    public $user1;
    public $user2;
    private $birthdateDifference;

    public function __construct(User $user1=null, User $user2=null, int $birthdateDifference=null)
    {
    }

    /**
     * @return mixed
     */
    public function getBirthdateDifference():int
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

}
