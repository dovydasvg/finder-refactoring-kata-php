<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

class SearchResult
{
    public $User2;
    public $User1;
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
        $this->birthdateDifference = $birthdateDifference;
    }

}