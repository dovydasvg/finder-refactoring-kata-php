<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

use InvalidArgumentException;

final class Finder
{
    const SEARCH_BY_SMALLEST_DIFFERENCE = 1;
    const SEARCH_BY_BIGGEST_DIFFERENCE = 2;

    /** @var User[] */
    private $users;
    /** @var ResultSorter */
    private $resultSorter;

    public function __construct(array $users)
    {
        $this->users = $users;
        $this->resultSorter = new ResultSorter();
    }

    public function find(int $searchLogic): UserBirthdateDifferenceValueObject
    {
        $searchResultList = $this->resultSorter->sortByUserBirthdates($this->users);
        if ($searchLogic === self::SEARCH_BY_SMALLEST_DIFFERENCE) {
            return $this->resultSorter->findResultWithSmallestDifference($searchResultList);
        }

        if($searchLogic === self::SEARCH_BY_BIGGEST_DIFFERENCE) {
            return $this->resultSorter->findResultWithBiggestDifference($searchResultList);
        }

        throw new InvalidArgumentException("No search logic matches the number $searchLogic .");
    }
}
