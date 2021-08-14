<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

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

    public function find(int $searchLogic): SearchResult
    {
        $searchResultList = $this->resultSorter->sortByUserBirthdays($this->users);

        if (count($searchResultList) < 1) {
            return new SearchResult();
        }

        return $this->findResultBySearchLogic($searchResultList, $searchLogic);
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
