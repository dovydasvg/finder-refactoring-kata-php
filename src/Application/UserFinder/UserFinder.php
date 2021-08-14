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
        $sortedUsersBirthdateDifferencesList = $this->resultSorter->sortByUserBirthdates($this->users);
        return $this->resultSorter->findResultWithSmallestDifference($sortedUsersBirthdateDifferencesList);
    }

}
