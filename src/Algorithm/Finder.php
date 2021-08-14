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

    public function find(int $searchLogic): SearchResult
    {
        $searchResultList = $this->resultSorter->sortByUserBirthdays($this->users);
        if ($searchLogic === self::SEARCH_BY_SMALLEST_DIFFERENCE) {
            return $this->resultSorter->findResultWithSmallestDifference($searchResultList);
        }

        if($searchLogic === self::SEARCH_BY_BIGGEST_DIFFERENCE) {
            return $this->resultSorter->findResultWithBiggestDifference($searchResultList);
        }

        throw new InvalidArgumentException("No search logic matches the number $searchLogic .");
    }

    /**
     * @param array $searchResultList
     * @param int $searchLogic
     * @return mixed
     */
    private function findResultBySearchLogic(array $searchResultList, int $searchLogic)
    {
        $finalResult = null;
        switch($searchLogic){
            case SearchLogic::SMALLEST_DIFFERENCE:
                $finalResult = $this->resultSorter->findResultWithSmallestDifference($searchResultList);
                break;
            case SearchLogic::BIGGEST_DIFFERENCE:
                $finalResult = $this->resultSorter->findResultWithBiggestDifference($searchResultList);
                break;
        }
        return $finalResult;
    }
}
