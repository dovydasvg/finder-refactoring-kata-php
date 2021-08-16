<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Application\UserFinder;

use CodelyTV\FinderKata\Domain\User\Model\User;

final class UserFinder
{

    /** @var User[] */
    private $users;
    /** @var ResultSorter */
    private $resultSorter;

    public function __construct(array $users)
    {
        $this->users = $users;
        $this->resultSorter = new ResultSorter();
    }

    public function findUsersWithBiggestBirthdateDifference(): UserBirthdateDifferenceValueObject
    {
        $sortedUsersBirthdateDifferencesList = $this->resultSorter->sortByUserBirthdates($this->users);
        return $this->resultSorter->findResultWithBiggestDifference($sortedUsersBirthdateDifferencesList);
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
