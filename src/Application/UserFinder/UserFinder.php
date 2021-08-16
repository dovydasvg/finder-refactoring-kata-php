<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Application\UserFinder;

use CodelyTV\FinderKata\Domain\User\Model\User;

final class UserFinder
{

    /** @var User[] */
    private $users;
    /** @var UserSorter */
    private $resultSorter;

    public function __construct(array $users)
    {
        $this->users = $users;
        $this->resultSorter = new UserSorter();
    }

    public function findUsersWithBiggestBirthdateDifference(): UserBirthdateDifferenceValueObject
    {
        if(count($this->users) < 2){
            return new UserBirthdateDifferenceValueObject();
        }
        $sortedUsers = $this->resultSorter->sortUsersByBirthdate($this->users);
        $lastUserIndex = count($sortedUsers)-1;
        $difference = $sortedUsers[$lastUserIndex]->getBirthDate()->getTimestamp()
            - $sortedUsers[0]->getBirthDate()->getTimestamp();
        return new UserBirthdateDifferenceValueObject($sortedUsers[$lastUserIndex],$sortedUsers[0],$difference);
    }

    public function findUsersWithSmallestBirthdateDifference(): UserBirthdateDifferenceValueObject
    {
        if(count($this->users) < 2){
            return new UserBirthdateDifferenceValueObject();
        }
        $sortedUsers = $this->resultSorter->sortUsersByBirthdate($this->users);
        $difference = $sortedUsers[1]->getBirthDate()->getTimestamp()
            - $sortedUsers[0]->getBirthDate()->getTimestamp();
        return new UserBirthdateDifferenceValueObject($sortedUsers[1],$sortedUsers[0],$difference);
    }

}
