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
        /** @var SearchResult[] $searchResultList */
        $searchResultList = [];


        $searchResultList = $this->compareUserBirthdays($searchResultList);

        if (count($searchResultList) < 1) {
            return new SearchResult();
        }

        $finalResult = $searchResultList[0];

        return $this->findResultBySearchLogic($searchResultList, $searchLogic, $finalResult);
    }

    /**
     * @param array $searchResultList
     * @return array
     */
    private function compareUserBirthdays(array $searchResultList): array
    {



        $usersCount = count($this->users);
        foreach ($this->users as $i => $user) {
            for ($j = $i + 1; $j < $usersCount; $j++) {
                $r = new SearchResult();

                if ($user->getBirthDate() < $this->users[$j]->getBirthDate()) {
                    $r->user2 = $user;
                    $r->user1 = $this->users[$j];
                } else {
                    $r->user2 = $this->users[$j];
                    $r->user1 = $user;
                }

                $difference = $r->user1->getBirthDate()->getTimestamp()
                    - $r->user2->getBirthDate()->getTimestamp();

                $r->setBirthdateDifference($difference);

                $searchResultList[] = $r;
            }
        }
        return $searchResultList;
    }

    /**
     * @param array $searchResultList
     * @param int $searchLogic
     * @param $finalResult
     * @return mixed
     */
    private function findResultBySearchLogic(array $searchResultList, int $searchLogic, $finalResult)
    {
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
