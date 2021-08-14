<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

use InvalidArgumentException;

final class Finder
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
        $searchResultList = $this->resultSorter->sortByUserBirthdates($this->users);
        return $this->resultSorter->findResultWithBiggestDifference($searchResultList);
    }

    public function findUsersWithSmallestBirthdateDifference(): UserBirthdateDifferenceValueObject
    {
        $searchResultList = $this->resultSorter->sortByUserBirthdates($this->users);
        return $this->resultSorter->findResultWithSmallestDifference($searchResultList);
    }

}
